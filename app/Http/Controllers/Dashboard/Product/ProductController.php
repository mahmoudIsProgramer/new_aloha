<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Ram;
use App\Models\Sim;
use App\Models\Size;
use App\Models\Type;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Capacity;
use App\Models\Category;
use App\Models\Material;
use App\Models\Subcategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use App\Models\Subsubcategory;
use Illuminate\Support\Facades\DB;
use App\Traits\Models\ProductTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\ProductFormRequest;

class ProductController extends Controller
{
  use ProductTrait;
  public function index(Request $request)
  {
    $categories = Category::Active()->get();
    $subcategories = Subcategory::Active()->get();
    $subsubcategories = Subsubcategory::Active()->get();

    $brands = Brand::Active()->get();

    $products = Product::when($request->search, function ($q) use ($request) {

      return $q->whereTranslationLike('name', '%' . $request->search . '%')->orWhere('product_code', 'like', '%' . $request->search . '%')->orWhere('porduct_sku_code', 'like', '%' . $request->search . '%')->orWhere('product_serial_number', 'like', '%' . $request->search . '%');
    })->when($request->category_id, function ($qq) use ($request) {

      return $qq->where('category_id', $request->category_id);
    })->when($request->subcategory_id, function ($qqq) use ($request) {

      return $qqq->where('subcategory_id', $request->subcategory_id);
    })->when($request->brand_id, function ($qqqq) use ($request) {

      return $qqqq->where('brand_id', $request->brand_id);
    })->when($request->created_at, function ($qqqqq) use ($request) {

      return $qqqqq->where('created_at', $request->created_at);
    })->when($request->status != null, function ($qqqqqq) use ($request) {

      return $qqqqqq->where('status', $request->status);
    })->when($request->featured != null, function ($qqqqqqq) use ($request) {

      return $qqqqqqq->where('featured', $request->featured);
    })->when($request->trending != null, function ($qqqqqqqq) use ($request) {

      return $qqqqqqqq->where('trending', $request->trending);
    })->when($request->on_sale != null, function ($qqqqqqqqq) use ($request) {

      return $qqqqqqqqq->where('on_sale', $request->on_sale);
    })->when($request->hot_deal != null, function ($qqqqqqqqqq) use ($request) {

      return $qqqqqqqqqq->where('hot_deal', $request->hot_deal);

      // })->with('productImages')->toSql();

    })->with('productImages')->latest()->paginate(15);

    return view('dashboard.products.index', compact('products', 'categories', 'subcategories', 'subsubcategories', 'brands'));
  } //end of index



  public function create()
  {
    $categories = Category::Active()->get();

    $sellers = Seller::Active()->get();
    $brands = Brand::Active()->get();

    $colors = Color::get();
    $sizes = Size::get();
    $capacities = Capacity::get();
    $materials  = Material::get();
    $rams = Ram::get();
    $sims = Sim::get();
    $types = Type::get();

    $products = Product::active()->latest()->get();

    return view('dashboard.products.create', compact('sellers', 'categories', 'products', 'brands',  'rams', 'capacities', 'sims', 'types', 'materials', 'colors', 'sizes'));
  } //end of create

  public function store(ProductFormRequest $request)
  {

    $this->insertProduct($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->back();
  } // end of update

  public function edit(Product $product)
  {

    $categories = Category::Active()->get();
    $sellers = Seller::Active()->get();
    $brands = Brand::Active()->get();

    $colors = Color::get();
    $sizes = Size::get();
    $capacities = Capacity::get();
    $materials  = Material::get();
    $rams = Ram::get();
    $sims = Sim::get();
    $types = Type::get();
    $products = Product::active()->latest()->get();

    $subcategories = Subcategory::Active()->where('category_id', $product->category_id)->get();
    $subsubcategories = Subsubcategory::Active()->where('subcategory_id', $product->subcategory_id)->get();
    $brands = Brand::Active()->get();
    $attachments = $product->productImages;

    return view('dashboard.products.edit', compact('product', 'sellers', 'categories', 'products', 'brands', 'rams', 'capacities', 'subcategories', 'subsubcategories', 'sims', 'types', 'materials', 'colors', 'sizes', 'attachments'));
  } // end of edit

  public function deleteImage($id)
  {

    $attachments = ProductImage::find($id);
    Storage::disk('public_uploads')->delete('product_images/' . $attachments->image);
    $attachments->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->back();
  }

  public function update(ProductFormRequest $request, Product $product)
  {
    $this->updateProduct($product, $request);
    session()->flash('success', __('site.updated_successfully'));
    return redirect()->back();

    return redirect()->route('dashboard.products.index');
  } //end of update

  public function copy(Product $product)
  {
    // dd($product->details);
    $this->copyProduct($product);
    session()->flash('success', __('site.updated_successfully'));

    return redirect()->route('dashboard.products.index');
  } //end of update

  public function approveProduct(Request $request, $products)
  {
    $products = Product::find($products);
    $products->update(['approved' => '1']);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->back();
  } // end of update

  public function product_delete(Product $product)
  {
    if (!$product) {
      return redirect()->back();
    }

    if ($product->image != 'default.png') {
      Storage::disk('public_uploads')->delete('products/' . $product->image);
    } //end of if

    // $attachments = Attachment::where('type_id',$product->id)->where('type','product')->get();
    // if( $attachments ){
    //     DeleteMultipleImage($product->id,'product','products');
    // }

    // $geomtric = Attachment::where('type_id',$product->id)->where('type','productGeometricShaps')->get();
    // if( $geomtric ){
    //     DeleteMultipleImage($product->id,'productGeometricShaps','products');
    // }

    $product->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.products.index');
  } //end of destroy

  public function multiple_property_action(Request $request)
  {

    $rules = [
      'option' => 'required',
      'properties_ids' => 'required|array',
      'properties_ids.*' => 'integer',
    ];
    $request->validate($rules);
    $option = $request->option;
    $ids = $request->properties_ids;

    if ($option == 'delete') {
      $action = Product::whereIn('id', $ids)->delete();
    } elseif ($option == 'approve') {
      $action = Product::whereIn('id', $ids)->update(['approved' => 1]);
    } elseif ($option == 'unApprove') {
      $action = Product::whereIn('id', $ids)->update(['approved' => 0]);
    } elseif ($option == 'featured') {
      $action = Product::whereIn('id', $ids)->update(['featured' => "featured"]);
    } elseif ($option == 'nonFeatured') {
      $action = Product::whereIn('id', $ids)->update(['featured' => "non featured"]);
    } else {
      return redirect()->back();
    }

    session()->flash('success', __('site.successfully_opertation'));
    return redirect()->route('dashboard.products.index');
  }
}//end of controller
