<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Brand;

class ProductController extends Controller
{

  public function productDetails(Request $request, Product $product)
  {
    $product->load([
      'productImages',
      'sellers',
      'reviews' => function ($q) {
        return $q->Active()->get();
      }
    ]);

    $relatedProducts = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id)->limit(3)->get();
    // dd($product->sellers()->pluck('seller_id'));
    // $product = Product::where('id',$id)->with([
    //   'productImages',
    //   'sellers',
    //   'reviews' => function ($q) {
    //     return $q->Active()->get();
    //   }
    // ])->whereHas('sellers')->first();

    // dd($product);

    // dd($product->getTotalBySeller());
    // dd($product->selectedSeller());

    // DB::enableQueryLog();
    $grouped_products = Product::whereIn('id', explode(',', $product->grouped_products))->get();
    $variations = [];
    foreach ($grouped_products as $product) {
      $variations[$product->id] = $product->variations_blade;
    }
    // dd(DB::getQueryLog());

    // dd($grouped_products);
    // $colors = Color::find(array_unique($grouped_products->pluck('color_id')->toArray()));
    // $sizes = Size::find(array_unique($grouped_products->pluck('size_id')->toArray()));

    // $arr_colors = [];
    // $arr_sizes = [];

    // dd($grouped_products->when($main_product->color_id, function ($color_id) {
    //   dd($color_id);
    //   return $color_id->where('color_id', $color_id);
    // })->first());
    // dd($main_product->color_id);
    // dd( $grouped_products);

    // foreach ($colors as $key => $value) {
    //   $arr_colors[$value->title] = $grouped_products->where('color_id', $main_product->color_id)->first()->value('id');
    // }

    // foreach ($sizes as $key => $value) {
    //   $arr_sizes[$value->title] = $grouped_products->where('size_id', $main_product->size_id)->first()->value('id');
    // }

    // $variations = [
    //   'colors' => $arr_colors,
    //   'sizes' => $arr_sizes,
    // ];

    // dd($variations);

    // $related = Product::where('category_id', $main_product->category_id)->latest()->limit(15)->get();

    return view('frontend.product.productDetails', compact('product', 'variations', 'relatedProducts'));
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
