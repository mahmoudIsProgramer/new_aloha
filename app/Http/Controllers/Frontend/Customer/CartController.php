<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\Models\CartTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\CartFormRequest;

class CartController extends Controller
{

  use  CartTrait;

  public function cart()
  {
    $products = $this->getCartProducts();
    // dd($products);

    $related = Product::latest()->limit(15)->get();

    return view('customer.cart', compact('products', 'related'));
  }

  public function addToCart(CartFormRequest $request)
  {
    $this->addProductToCart();
    session()->flash('success', __('site.added_successfully'));
    return redirect()->back()->withInput();
  } // end of update

  public function removeFromCart(CartFormRequest $request)
  {
    $this->removeProductFromCart();
    session()->flash('success', __('site.added_successfully'));
    return redirect()->back()->withInput();
  } // end of update

}
