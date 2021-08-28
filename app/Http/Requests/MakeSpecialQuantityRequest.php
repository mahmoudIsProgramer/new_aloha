<?php

namespace App\Http\Requests;

use App\Customer;
use App\SpecialQuantities;
use App\Rules\CheckWalletCharged;
use App\Http\Requests\BaseRequest;

class MakeSpecialQuantityRequest extends BaseRequest
{

  public $rules = [];

  public function authorize()
  {
    return true;
  }

  public function rules()
  {

    if ($this->isMethod('post')) {
      return $this->createRules();
    } elseif ($this->isMethod('put')) {
      return $this->updateRules();
    }
  }

  public function updateRules()
  {

    // dd(request()->all() );
    $customer = Customer::find(request()->customer_id);

    $order = SpecialQuantities::find(request('order_id'));
    // dd($order->products);

    $this->rules += [

      'customer_id' => ['bail', 'required', 'exists:customers,id'],

      'order_id' => ['bail', 'required', 'exists:special_quantities,id'],

      'status' => ['bail', 'required', function ($attribute, $value, $fail) use ($customer, $order) {

        if ($value == 'accepted') {

          #check product stock befor make order
          foreach ($order->products as $product) {

            #check stock
            if ($product->stock < $product->pivot->qty) {
              $fail(__('site.Some Products Out Of Stock', ['productName' => $product->name]));
            }
          }

          if ($customer->wallet < $order->total) {
            $fail(__('site.Please chareg wallet current balance:', ['balance' => $customer->wallet]));
          }
        }
      }],

    ];
    // dd($this->rules);
    return $this->rules;
  }


  public function createRules()
  {

    $product = $this->route('product');

    $this->rules += [];

    return $this->rules;
  }
}
