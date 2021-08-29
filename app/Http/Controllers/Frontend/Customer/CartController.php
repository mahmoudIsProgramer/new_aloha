<?php

namespace App\Http\Controllers\Frontend\Customer;

use Illuminate\Http\Request;
use App\Traits\Models\CartTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartFormRequest;

class CartController extends Controller
{

  use  CartTrait;

  public function cart()
  {
    $productSellers = $this->getCartProducts();
    // dd($productSellers);

    return view('frontend.customer.cart', compact('productSellers'));
  }

  public function addToCart(CartFormRequest $request)
  {
    $this->addProductToCart();
    session()->flash('success', __('site.added_successfully'));
    return redirect()->back()->withInput();
  } // end of update

  public function removeFromCart(Request $request)
  {
    $this->removeProductFromCart();
    session()->flash('success', __('site.added_successfully'));
    return redirect()->back()->withInput();
  } // end of update

}
