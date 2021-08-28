<?php

namespace App\Http\Controllers\Frontend\Customer;

use Carbon\Carbon;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Http\Controllers\Controller;
use App\Notifications\PasswordResetRequest;

class PasswordResetController extends Controller
{

  public function forget_password()
  {

    return view("customer.auth.passwords.email");
  }

  public function send_reset_password(Request $request)
  {

    // dd('hi');
    $request->validate([
      'email' => 'required|string|email|exists:customers',
    ]);

    $user = Customer::where('email', $request->email)->first();

    $passwordReset = PasswordReset::updateOrCreate(
      ['email' => $user->email],
      [
        'email' => $user->email,
        'token' => str_random(60)
      ]
    );

    if ($user && $passwordReset)
      $user->notify(new PasswordResetRequest($passwordReset->token, '/customer/password/find/'));

    session()->flash('success', 'reset passport link already sent');

    return redirect()->route("customer.register");
  }

  public function find($token)
  {

    $passwordReset = PasswordReset::where('token', $token)->first();
    if (!$passwordReset) {
      return response()->json([
        'message' => 'This password reset token is invalid.'
      ], 404);
    }

    if (Carbon::parse($passwordReset->updated_at)->addMinutes(720)->isPast()) {
      $passwordReset->delete();
      return response()->json([
        'message' => 'This password reset token is invalid.'
      ], 404);
    }

    return view('customer.auth.passwords.reset', compact('passwordReset'));
  }

  public function reset(Request $request)
  {
    $request->validate([
      'email' => 'required|string|email',
      // 'password' => 'required|string|confirmed',
      'password' => 'required|string|min:6',
      'token' => 'required|string',
      // 'type' => 'required|string|in:teacher,student'
    ]);

    $passwordReset = PasswordReset::where([
      ['token', $request->token],
      ['email', $request->email],
      // ['type', $request->type]
    ])->first();

    if (!$passwordReset)
      return response()->json([
        'message' => 'This password reset token is invalid.'
      ], 404);

    // $user = $this->getUserObjectByType($request->type);
    $user = Customer::where('email', $request->email)->first();

    if (!$user)
      return response()->json([
        'message' => 'We can t find a user with that e-mail address.'
      ], 404);

    $user->password = bcrypt($request->password);
    $user->save();
    $passwordReset->delete();

    session()->flash('success', __('site.updated_successfully'));

    return redirect()->route("customer.register");
  }
}
