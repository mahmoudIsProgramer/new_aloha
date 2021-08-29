<?php

namespace App\Traits\Models;

use App\Models\Promocode;
use App\Models\ProductSeller;

trait CartTrait
{

  public function getCartProducts()
  {
    return getCustomer()->productSellers;
  }

  public function addProductToCart()
  {

    $productSeller = ProductSeller::find(request()->product_seller_id);
    $customer = getCustomer();

    if ($productSeller->inCart) {

      $customer->productSellers()->syncWithoutDetaching([request()->product_seller_id  => ['qty' => request('qty') ?? 1]]);
    } else {

      $customer->productSellers()->attach([request()->product_seller_id  => ['qty' => request('qty') ?? 1]]);
    }

    // $this->updatePromocodeDiscount();

    return true;
  }

  public function removeProductFromCart()
  {
    getCustomer()->productSellers()->detach(request()->product_seller_id);

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
