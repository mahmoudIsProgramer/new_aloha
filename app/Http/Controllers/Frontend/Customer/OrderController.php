<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\Delivery;
use App\Traits\OrderTrait;
use App\Traits\Models\CartTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\MakeOrderRequest;

class OrderController extends Controller
{

  use  CartTrait, OrderTrait;

  #get
  public function checkout()
  {
    $customer = getCustomer()->load('productSellers');

    $addresses = $customer->addresses;

    $deliveries = Delivery::get();
    $taxes = $this->getTaxes($customer->totalCart);
    return view('frontend.customer.checkout', compact('customer', 'taxes', 'deliveries', 'addresses'));
  }

  #post
  public function checkoutPost(MakeOrderRequest $request)
  {
    $customer = getCustomer();

    $request_data = $this->orderData($customer);

    # create order
    $this->makeOrder($request_data, $customer);

    session()->flash('success', __('site.Success Operation'));
    return redirect('/');
  } // end of update

}
