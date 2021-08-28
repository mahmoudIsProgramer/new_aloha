<?php

namespace App\Traits\Models;

use App\Models\Product;
use App\Models\Promocode;

trait CartTrait
{

  public function getCartProducts()
  {
    return getCustomer()->products;
  }

  public function addProductToCart()
  {

    $product = Product::find(request()->product_id);

    if ($product->inCart) {

      getCustomer()->products()->syncWithoutDetaching([request()->product_id  => ['qty' => request('qty') ?? 1]]);
    } else {

      getCustomer()->products()->attach([request()->product_id  => ['qty' => request('qty') ?? 1]]);
    }

    $this->updatePromocodeDiscount();

    return true;
  }

  public function removeProductFromCart()
  {

    getCustomer()->products()->detach([request()->product_id]);

    $this->updatePromocodeDiscount();

    return true;
  }

  public function updatePromocodeDiscount()
  {

    if (!request()->is('api/*')) {
      $sum = getCustomer()->products->sum('product_total_has_not_offer') ?? 0;

      if (session()->has('coupon')) {
        $code = session()->get('coupon')['name'];
        $promocode = Promocode::where('code', $code)->first();
        if ($promocode) {
          session()->put('coupon', [
            'name' => $code,
            'discount' => $promocode->discount($sum),
          ]);
        }
      }

      if ($sum) {
        session()->forget('coupon');
      }
    } // end if

    return true;
  } // end of update

}
