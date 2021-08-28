<?php

namespace App\Http\Requests\FrontEnd;

use App\Promocode;
use App\Rules\CheckWalletCharged;
use Illuminate\Foundation\Http\FormRequest;

class MakeOrderRequest extends FormRequest
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

  public function createRules()
  {

    $customer = getCustomer();

    $this->rules += [

      'payment_method' => ['bail', 'required',  new CheckWalletCharged(request()->payment_method, $customer, $customer->total_cart),  'in:' . paymentMethods('str'), function ($attribute, $value, $fail) use ($customer) {

        $total = $customer->total_cart;
        #reject coupon if it's value greater than total of order
        if ($total == 0) {
          $fail(__('site.Cart Is Empty'));
        }

        #check product stock befor make order
        foreach ($customer->products as $product) {

          #check stock
          if ($product->stock < $product->pivot->qty) {
            $fail(__('site.Some Products Out Of Stock', ['productName' => $product->name]));
          }
        }
      }],
      'code' => ['nullable', function ($attribute, $value, $fail) use ($customer) {

        $code = Promocode::where('code', request()->code)->first();

        if ($code == null) {
          $fail(__('site.Promocode Not Found'));
        } else {

          #if expired
          if ($code->startDate > now() || $code->endDate < now() || $code->status == 0 || $code->used >= $code->limit) {
            $fail(__('site.Promocode Expired'));
          }

          #check if already used by same user
          // $checkAlreadyUsed = DB::table('customer_promocode')->where('customer_id', $customer->id)->where('promocode', $code->code)->first();
          // if ($checkAlreadyUsed) {
          //   $fail(__('site.Promocode Already Used'));
          // }

          #reject coupon if it's value greater than total of order
          if ($code->discount($customer->totalCart) > $customer->products->sum('total')) {
            $fail(__('site.Can Not Apply Coupon'));
          }

          #minimum_order_to_apply_promocode
          if (config('site_options.minimum_order_option') == "1") {
            // dd(config('site_options.minimum_order_to_apply_promocode'));
            $min = config('site_options.minimum_order_to_apply_promocode');
            if ($min > $customer->totalCart) {
              $fail(__('site.Can Not Apply Coupon As Minumum Order is', ['min' => $min]));
            }
          }
        }
      }],
      'city_id' => ['required'],
    ];


    return $this->rules;
  }


  public function updateRules()
  {

    $product = $this->route('product');

    $this->rules += [];

    return $this->rules;
  }
}
