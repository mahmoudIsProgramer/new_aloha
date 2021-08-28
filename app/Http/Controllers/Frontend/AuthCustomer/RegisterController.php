<?php

namespace App\Http\Controllers\Frontend\AuthCustomer;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CustomerFormRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = '/';

  /**
   * Create a new controller instance.
   *
   * @return void
   */

  public function __construct()
  {
    $this->middleware('guest');
  }

  #customer
  public function showRegisterForm()
  {
    return view('frontend.authCustomer.register');
  }

  #customer
  public function createCustomer(CustomerFormRequest $request)
  {
    $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);

    if ($request->image) {

      $request_data['image'] = uploadImages($request->image, 'customers/', '');
    } // end of if

    $request_data['password'] = bcrypt($request->password);

    $customer = Customer::create($request_data);

    // dd($customer);
    Auth::guard('customer')->loginUsingId($customer->id);

    return redirect()->route('home');

    session()->flash('success',  __('site.Success Regesteration'));

    return redirect()->route('customer.login');
  } //end of store

}
