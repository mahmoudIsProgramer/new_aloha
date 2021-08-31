<?php

namespace App\Traits;

use App\Models\Tax;
use App\Models\Seller;
use App\Models\Delivery;
use App\Models\Promocode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

trait OrderTrait
{
  public function orderData($customer)
  {
    $request_data = request()->except(['']);

    $subtotal = $customer->totalCart;

    $taxes = $this->getTaxes($subtotal);

    $delivery_fees = $this->delivery_fees();

    // if (request('code')) {
    //   $request_data = $this->getPromocodeValue($request_data, $subtotal);
    // }

    $request_data['delivery_fees'] = $delivery_fees;
    $request_data['taxes'] = $taxes;
    $request_data['subtotal'] = $subtotal;
    $request_data['device_type'] = $subtotal;

    // $promocode_value = $request_data['promocode_value'] ?? 0;

    $request_data['total'] = $subtotal + $taxes + $delivery_fees;
    // $request_data['commission'] =  $request_data['total'] * commission();

    return  $request_data;
  } //end of update

  public function makeOrder($request_data, $customer)
  {

    $order = $customer->orders()->create($request_data);

    $this->generateOrderProducts($customer, $order); // for admin

    $this->generateSubordersProducts($order); // for sellers

    // $this->removeCart();

    return true;
  }

  public function generateOrderProducts($customer, $order)
  {

    foreach ($customer->productSellers as $productSeller) {

      $total = $productSeller->qtyInCart * $productSeller->total;

      $order->productSellers()->attach($productSeller->id, [
        'price' => $productSeller->total,
        'qty' => $productSeller->qtyInCart,
        'total' => $total,
      ]);

      $productSeller->update([
        'stock' => DB::raw('stock - ' . $productSeller->qtyInCart),
      ]);
    }

    return true;
  }

  public function generateSubordersProducts($order)
  {
    $orderItems = $order->productSellers;

    foreach ($orderItems->groupBy('seller_id') as $seller_id => $productSellers) {


      $total = $productSellers->sum('pivot.total');
      $suborder = $order->subOrders()->create([
        'seller_id' => $seller_id,
        'total' => $total,
      ]);

      foreach ($productSellers as $productSeller) {

        // $total = $productSeller->pivot->qty * $productSeller->pivot->total;

        $suborder->productSellers()->attach($productSeller->id, [
          'price' => $productSeller->pivot->price,
          'qty' => $productSeller->pivot->qty,
          'total' =>  $productSeller->pivot->total,
          // 'product_seller_id' => $productSeller->id,
          // 'sub_transaction_id' => $this->id,
        ]);

        // dd($suborder);
      }

      // dd($suborder);

    }
  }

  public function delivery_fees()
  {

    return 0;
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

  public function getTaxes($subtotal)
  {

    $values_amount = Tax::Active()->where('type', 'value')->sum('value') ?? 0;
    $percents = Tax::Active()->where('type', 'percent')->get();
    $percent_amount = 0;

    foreach ($percents as $key => $value) {
      $percent_amount = $percent_amount + ($subtotal * $value->value * 0.01);
    }

    return $values_amount + $percent_amount;
  }
}
