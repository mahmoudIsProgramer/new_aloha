<?php

namespace App\Http\Controllers\Frontend\AuthCustomer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
  use AuthenticatesUsers;

  /**
   * Where to redirect customers after login.
   *
   * @var string
   */

  protected $redirectTo = '/';

  public function __construct()
  {
    $this->middleware('guest:customer')->except('logout');
  }

  public function showLoginForm()
  {
    setPreviousUrl();
    return view('frontend.authCustomer.login');
  }

  public function login(Request $request)
  {

    // LogoutAllGuards();

    $this->validate($request, [
      'email'   => 'required',
      'password' => 'required|min:6'
    ]);

    if ($this->loginCustomer($request)) {

      return redirect(session()->get('url.intended', '/'));
      // return redirect()->route('home') ;
    }

    return back()->withInput($request->only('email', 'remember'))->with('error', __('site.email or password not correct'));
  }

  public function loginCustomer($request)
  {

    $loginSuccess = false;
    if ($cu = Auth::guard('customer')->attempt([
      'email' =>  $request->email,
      'password' => $request->password,
      'status' => 1,
    ], $request->get('remember'))) {
      session()->flash('success', __('site.Successfully Login'));
      $loginSuccess = true;
    }

    return $loginSuccess;
  }

  // public function logout(Request $request)
  // {

  //   Auth::guard('customer')->logout();

  //   $request->session()->invalidate();
  //   return redirect()->route('home');
  // }
}
