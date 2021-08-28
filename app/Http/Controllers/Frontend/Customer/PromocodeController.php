<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\Promocode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FrontEnd\PromocodeDiscountRequest;

class PromocodeController extends Controller
{

  public function getPromocodeDiscount(PromocodeDiscountRequest $request)
  {
    $promocode = Promocode::where('code', $request->code)->first();
    session()->put('coupon', [
      'name' => $promocode->code,
      'discount' => $promocode->discount(getCustomer()->products->sum('product_total_has_not_offer')),
    ]);

    session()->flash('success', __('site.Success Operation'));
    return redirect()->back();
  } // end of update

  public function removePromocode(Request $request)
  {
    session()->forget('coupon');
    session()->flash('success', __('site.Success Operation'));
    return redirect()->back();
  } // end of update

}
