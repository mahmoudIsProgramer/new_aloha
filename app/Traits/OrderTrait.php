<?php

namespace App\Traits;

use App\Delivery;
use App\Promocode;
use App\WalletHistory;
use Illuminate\Support\Facades\DB;

trait OrderTrait
{

  use WalletTrait;

  public function orderData()
  {

    $subtotal = 0;

    $subtotal = $this->customer->totalCart;

    $this->request_data['subtotal'] = $subtotal;

    $this->request_data['order_type'] = "normal_order";

    $this->request_data['taxes'] =  getTaxes($subtotal);

    $this->delivery_fees();

    if (request('code')) {
      $this->getPromocodeValue($subtotal);
    }

    $this->request_data['total'] = $this->request_data['subtotal'] + ($this->request_data['taxes'] ?? 0) + ($this->request_data['delivery_fees'] ?? 0)  - ($this->request_data['promocode_value'] ?? 0);

    return  true;
  } //end of update

  public function fillOrderDetails()
  {
    $order = $this->customer->orders()->create($this->request_data);

    $this->generateOrderProducts($order);

    // start payment status and wallet operations
    if (request('payment_method') == 'wallet') {

      $this->updateWallet($this->customer, $order->total, 'withdraw', 'اتمام طلب');
      // $this->makeWalletOrder($order, $this->customer);

      $order->update(['payment_status' => 1]);
    } // end payment status and wallet operations

    // start payment status and wallet operations
    if (request('payment_method') == 'premium') {

      $this->generatePremium($order, $this->customer);

      $order->update(['payment_status' => 0]);
    } // end payment status and wallet operations

    // start payment status and wallet operations
    if (request('payment_method') != 'payOnline') {

      $this->removeCart();
    } // end payment status and wallet operations

    // start  send confirm email
    if (request('customer_email') || $this->customer->email) {

      $this->confirmationMail($order, $this->customer);
    } // end send confirm email

    return $order;
  }

  public function generateOrderProducts($order)
  {

    foreach ($this->customer->products as $product) {

      $total = $product->pivot->qty * $product->total;

      $order->products()->attach($product->id, [
        'price' => $product->total,
        'qty' => $product->pivot->qty,
        'total' => $total,
        'price_before_discount' => $product->sale_price,
        'product_id' => $product->id,
      ]);

      $product->update([
        'count_solid' => DB::raw('count_solid + ' . $product->pivot->qty),
        'stock' => DB::raw('stock - ' . $product->pivot->qty),
      ]);
    }

    return true;
  }

  public function generatePremium($order, $customer)
  {
    $months  = config('site_options.months') ?? 10;

    $amount = $order->total / $months;

    $arr = ['order_id' => $order->id, 'amount' => $amount];

    $premuims  = [];
    for ($i =  0; $i < 10; $i++) {
      array_push($premuims, $arr);
    }

    $premiums = $customer->premiums()->createMany($premuims);

    $this->updateWallet($customer, $order->total, 'withdraw', 'اضافة اقساط شهرية');
    // $this->makeWalletHistory($customer, $order->total, 'withdraw','اضافة اقساط شهرية');

    // dd($premuims);

    return true;
  }

  public function delivery_fees()
  {
    if (config('site_options.applay_package') == 1) {
      if (has_permission($this->customer, 'free_delivery')) {
        return 0;
      }
    }

    $delivery = Delivery::where('city_id', request()->city_id)->first();

    $this->request_data['delivery_fees'] = $delivery->price;

    return true;
  }

  public function removeCart()
  {
    $this->customer->products()->sync([]);
    return true;
  }

  public function orders()
  {

    return getCustomer()->orders()->with('products')->latest()->get();
  }

  public function getPromocodeValue($subtotal)
  {
    $code = Promocode::Active()->where('code',  request('code'))->first();

    $this->request_data['promocode_value'] = 0;
    if ($code) {

      $discount = $code->discount($subtotal);

      $this->request_data['promocode'] = $code->code;
      $this->request_data['promocode_value'] = $discount;

      $code->increment('used');
      $insert = DB::table('customer_promocode')->insert(['customer_id' => getCustomer()->id, 'promocode' => $code->code]);
    }

    return true;
  }

  // public function makeWalletOrder($order, $customer)
  // {

  //   // $this->makeWalletHistory($customer, $order->total, 'withdraw','اتمام طلب');

  //   $this->updateWallet($customer, $order->total, 'withdraw' ,'اتمام طلب');

  //   return true;
  // } //end fo category

  public function confirmationMail($order, $customer)
  {

    $message = "Congratulatin! Your Order Is Done Successfully Order ID= " . $order->id;
    $subject = __('site.shipping box orders');

    $data = [
      'msg' => $message,
      'to' => request('customer_email') ?? $customer->email,
      'subject' => $subject
    ];

    sendEMail($data);

    return true;
  } //end fo category

}
