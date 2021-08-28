<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use App\Models\Order;
use App\Traits\SendSms;
use App\Models\Customer;
use App\Traits\WalletTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
  use SendSms, WalletTrait;

  public function index(Request $request)
  {

    $customers = Customer::all();
    $orders = Order::when($request->fromDate, function ($q) use ($request) {

      return $q->where('created_at', '>=', $request->fromDate);
    })->when($request->toDate, function ($qq) use ($request) {

      return $qq->where('created_at', '<=', $request->toDate);
    })->when($request->customer_id, function ($qqq) use ($request) {

      return $qqq->where('customer_id', $request->customer_id);
    })->when($request->status, function ($qqqq) use ($request) {

      return $qqqq->where('status', $request->status);
    })->with('products')->latest()->paginate(50);

    // ->where('payment_status',1)
    return view('dashboard.orders.index', compact('orders', 'customers'));
  } // end of index

  public function edit($order)
  {

    $users = User::all();
    $order  = Order::find($order);
    return view('dashboard.orders.edit', compact('order', 'users'));
  } //end of edit

  public function orderDetails($order)
  {
    $order  = Order::find($order);
    return view('dashboard.orders.orderDetails', compact('order'));
  } //end of edit
  // reutur whole order
  public function returnOrder($order)
  {

    $order  = Order::where('id', $order)->with(['products'])->first();
    $customer = Customer::find($order->customer_id);

    #create order Details
    foreach ($order->products as $product) {

      // update stock
      $this->updateProductStock($product, $product->pivot->qty);

      //update updateProductStatus
      $this->updateProductStatus($order, $product->id);
    }

    // $this->makeWalletHistory($customer, $order->total, 'purchase', 'ارجاع قيمة طلب');

    // update wallet
    $this->updateWallet($customer, (float) $order->total, 'purchase');


    $order->update([
      'status' => 'returned'
    ]);

    $this->sendReturnOrderStatusMail($customer->email);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.orders.index');
  } //end of edit

  // specifif item from order
  public function returnProduct($order, $product)
  {

    $order  = Order::findOrFail($order)->with('products')->first();
    $product = $order->products()->where('product_id', $product)->first();
    $customer = Customer::find($order->customer_id);

    // update stock
    $this->updateProductStock($product, $product->pivot->qty);

    //update product
    $this->updateProductStatus($order, $product->id);


    // $this->makeWalletHistory($customer, $order->total, 'purchase', 'ارجاع قيمة منتج');

    $total = $product->pivot->total * $product->pivot->qty;
    $this->updateWallet($customer, (float)  $total, 'purchase');

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.orders.index');
  } //end of edit

  public function sendReturnOrderStatusMail($sendTo)
  {
    $message =  __('site.your order has been returned');
    $subject = __('site.cofirmation mail');
    $data = [
      'msg' => $message,
      'to' => $sendTo,
      'subject' => $subject
    ];
    sendEMail($data, 'emails.mail');
    return true;
  } //end of update

  public function updateProductStock($product, $qty)
  {

    if ($product) {
      $product->update([
        'count_solid' => DB::raw('count_solid - ' . $qty),
        'stock' => DB::raw('stock + ' . $qty),
      ]);
    }

    return true;
  }

  public function increaseWallet($customer, $amount)
  {

    $customer->update([
      'wallet' => DB::raw('wallet + ' . $amount),
    ]);

    // dd($amount);

    $this->updateWallet($customer, (float)$amount, 'purchase');
    return true;
  }

  public function updateProductStatus($order, $product)
  {
    $order->products()->updateExistingPivot($product, [
      'status' => 'returned'
    ]);

    return true;
  }

  public function update(Request $request, $order)
  {

    $order = Order::find($order);
    $rules = [];
    $rules += [
      // 'user_id' => 'required|exists:users,id',
      'status' => 'required|in:' . orderStatusAsString(),
    ];

    $request->validate($rules);

    $order->status =  $request->status;

    #if status change send email and sms to customer
    if ($order->isDirty('status')) {
      $customer = $order->customer;

      $msg = orderStatusMessage($order->status);

      $email = $order->customer_email ?? $customer->email;
      sendEMail($msg, $email);
    }

    $order->save();

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.orders.index');
  } //end of update

  public function destroy($orders)
  {
    $order = Order::find($orders);
    if (!$order) {
      return redirect()->back();
    }
    $order->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.orders.index');
  } //end of destroy

}
