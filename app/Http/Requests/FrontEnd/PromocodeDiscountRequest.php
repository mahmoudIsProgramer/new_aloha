<?php

namespace App\Http\Requests\FrontEnd;

use App\Promocode;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;

class PromocodeDiscountRequest extends FormRequest
{

  public $rules = [];

  protected $errorBag = 'coupon';

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

      'code' => ['bail', 'required', function ($attribute, $value, $fail)  use ($customer) {

        $code = Promocode::where('code', request()->code)->first();

        if ($code == null) {
          $fail(__('site.Promocode Not Found'));
        } else {

          #if expired
          if ($code->startDate > now() || $code->endDate < now() || $code->status == 0 || $code->used >= $code->limit) {
            $fail(__('site.Promocode Expired'));
          }

          #reject coupon if it's value greater than total of order
          if ($code->discount($customer->products->sum('product_total_has_not_offer')) > $customer->products->sum('product_total_has_not_offer')) {
            $fail(__('site.Can Not Apply Coupon'));
          }

          #check if already used by same user
          $checkAlreadyUsed = DB::table('customer_promocode')->where('customer_id', $customer->id)->where('promocode', $code->code)->first();
          if ($checkAlreadyUsed) {
            session()->forget('coupon');
            $fail(__('site.Promocode Already Used'));
          }

          #minimum_order_to_apply_promocode
          if (config('site_options.minimum_order_option') == "1") {
            // dd(config('site_options.minimum_order_to_apply_promocode'));
            $min = config('site_options.minimum_order_to_apply_promocode');
            if ($min > $customer->products->sum('total_product_price_in_cart')) {
              $fail(__('site.Can Not Apply Coupon As Minumum Order is', ['min' => $min]));
            }
          }

          #reject coupon if belong to more than one teacher
          // if( $this->checkUniqueTeachersForPromocode() ){
          //     $fail( __('site.Can Not Apply Coupon For More Than One Seller'));
          // }

          // foreach( $customer->cart->products as $product) {

          //     #check if product have offer or discount or hotdeal
          //     if($product->checkIfHasOffer()||$product->discount!=0||$product->hot_deal==1){
          //         $fail( __('site.Can Not Apply Promocode As Product Have Offer Or Discount Or Already Hot Deal',['productName'=>$product->name]));
          //     }

          // }

        }
      }],

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
