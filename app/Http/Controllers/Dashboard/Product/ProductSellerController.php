<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Seller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use App\Traits\Models\GetterTrait;
use App\Traits\Models\ProductTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSellerFormRequest;

class ProductSellerController extends Controller
{

  use  ProductTrait, GetterTrait;
  public function index(Request $request, Product $product)
  {
    $product->load('sellers');
    $sellers = $product->sellers;

    return view('dashboard.products.sellers.index', compact('product', 'sellers'));
  } // end of index

  public function create(Product $product)
  {

    $sellers = $this->getSellers();

    return view('dashboard.products.sellers.create', compact('product', 'sellers'));
  } //end of create

  public function store(ProductSellerFormRequest $request, Product $product)
  {

    $request_data = $request->except(['parameters']);

    $seller = Seller::find(request('seller_id'));
    $this->attachProductToSeller($product, $seller);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.products.sellers.index', ['product' => $product->id]);
  } //end of store

  public function edit(Product $product, Seller $seller)
  {
    $sellers = $this->getSellers();

    $productSeller = ProductSeller::where('product_id', $product->id)->where('seller_id', $seller->id)->first();

    return view('dashboard.products.sellers.edit', compact('productSeller', 'product', 'seller', 'sellers'));
  } // end of edit

  public function update(ProductSellerFormRequest $request, Product $product, ProductSeller $productSeller)
  {
    $seller = Seller::find(request('seller_id'));
    $this->attachProductToSeller($product, $seller);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.products.sellers.index', ['product' => $product->id]);
  } //end of update

  public function destroy(Product $product, Seller $seller)
  {
    if (!$product->sellers()->find($seller->id)) {
      return redirect()->back();
    }

    $product->sellers()->detach($seller);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->back();
    return redirect()->route('dashboard.products.sellers.index', ['product' => $product->id]);
  } // end of destroy

} //end of controller
