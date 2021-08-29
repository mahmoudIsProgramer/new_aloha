<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\Delivery;
use App\Traits\OrderTrait;
use App\Traits\Models\CartTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\MakeOrderRequest;

class OrderController extends Controller
{

  use  CartTrait, OrderTrait;

  public $request_data = [];
  public $customer = '';

  public function __construct()
  {
    $this->request_data = request()->except(['code']);
  }

  #get
  public function checkout()
  {
    $customer =  getCustomer();

    $deliveries = Delivery::get();
    $taxes = getTaxes($customer->totalCart);
    return view('customer.checkout', compact('customer', 'taxes', 'deliveries'));
  }

  #post
  public function checkoutPost(MakeOrderRequest $request)
  {
    $this->customer =  getCustomer();

    $request_data = $this->orderData();

    # create order
    $order = $this->fillOrderDetails($request_data);

    // payOnline method
    if (request('payment_method') == 'payOnline') {

      // if order append   1 from the left
      $merchanttransactionId = "1" . $order->id;
      // $merchanttransactionId =  $order->id;
      // Log::info('checkoutPost order id :' . $order->id);
      session(['merchanttransactionId' => $merchanttransactionId]);

      // dd(session('merchanttransactionId'));
      $order->update(['merchanttransactionId' => $merchanttransactionId]);

      $checkoutId = $this->prepareCheckOut($merchanttransactionId, $order->total);

      // Log::info('merchanttransactionId:' . $merchanttransactionId);

      return view('customer.paymentPage', compact('checkoutId'));
    } // end payment status and wallet operations

    // removeSession();

    session()->flash('success', __('site.Success Operation'));
    return redirect('/');
  } // end of update
  #post



}
