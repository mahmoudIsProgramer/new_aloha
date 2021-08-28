<?php

namespace App\Http\Controllers\Frontend\Customer;


use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Models\CustomerTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CustomerFormRequest;
use App\Http\Requests\CustomerChangePasswordFormRequest;

class ProfileController extends Controller
{

  use CustomerTrait;
  public $path = 'frontend.customer.';

  public function logout(Request $request)
  {
    // LogoutAllGuards();
    Auth::guard('customer')->logout();

    $request->session()->invalidate();
    return redirect()->route('home');
  }

  public function profile()
  {
    $customer = getCustomer();

    // $orders = $customer->orders;
    // $cities = City::all();
    // $states = State::where('city_id', $customer->city_id)->get();
    // $orders =  $customer->orders()->with('products')->latest()->get();

    return view('frontend.customer.profile', compact('customer'));
  }

  public function edit_profile()
  {
    $customer = getCustomer();

    return view('customer.edit_profile', compact('customer'));
  }

  public function orders()
  {
    $customer = getCustomer();
    return view('customer.orders', compact('customer'));
  }

  public function orderDetails($order)
  {
    $order = Order::where('id', $order)->with('products')->first();

    return view('customer.orderDetails', compact('order'));
  }
  public function favorites()
  {
    return view('customer.favorites');
  }

  public function change_password_view()
  {
    return view($this->path . '.change_password_view');
  }

  public function update_profile(CustomerFormRequest $request, Customer $customer)
  {

    $this->updateCustomer($customer, $request);

    session()->flash('success', __('site.updated_successfully'));

    return redirect()->route('customer.profile');
  } //end of update

  public function change_password(CustomerChangePasswordFormRequest $request)
  {

    getCustomer()->update(['password' => bcrypt($request->password)]);

    session()->flash('success', __('site.updated_successfully'));
    return back();
  } // end of update

}
