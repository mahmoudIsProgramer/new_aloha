<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductSeller;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{

  public function productDetails(Request $request, Product $product)
  {

    $product->load([
      'productImages',
      'sellers',
      'reviews' => function ($q) {
        return $q->Active()->get();
      },
      'productSeller'
    ]);

    $seller = $product->selectedSeller(request('seller_id'));

    $productSeller = ProductSeller::where('product_id', $product->id)->where('seller_id', $seller->id)->first();

    // dd($productSeller);

    $relatedProducts = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id)->limit(3)->get();

    return view('frontend.product.productDetails', compact('product', 'relatedProducts', 'seller', 'productSeller'));
  } //end of index

  public function  products(Request $request)
  {

    $perPage = request('perPage') ?? 4;

    $brands = Brand::Active()->get();

    $products = Product::whenSearch($request->search)

      ->whenCategory($request->category_id)

      ->whenSubCategory($request->subcategory_id)

      ->whenBrand($request->brand_id)

      ->whenFromPrice()

      ->whenToPrice()

      ->Active()

      ->latest()

      ->paginate($perPage);


    return view('frontend.products', compact('products', 'brands'));
  }
}
