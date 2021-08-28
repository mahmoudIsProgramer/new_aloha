<?php

namespace App\Http\Controllers\Dashboard;


use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductVariantFormRequest;

class ProductVariantController  extends Controller
{
  public function index(Request $request)
  {

    $variations = ProductVariant::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.variations.index', compact('variations'));
  } //end of index

  public function create()
  {

    return view('dashboard.variations.create');
  } //end of create


  public function store(ProductVariantFormRequest $request)
  {
    $this->insertProductVariant($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.variations.index');
  } //end of store

  public function edit(ProductVariant $variation)
  {
    return view('dashboard.variations.edit', compact('variation'));
  } //end of edit

  public function update(ProductVariantFormRequest $request, ProductVariant $variation)
  {
    $this->updateProductVariant($variation, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.variations.index');
  } //end of update

  public function destroy(ProductVariant $variation)
  {
    if (!$variation) {
      return redirect()->back();
    }

    $this->destroyProductVariant($variation);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.variations.index');
  } //end of destroy

}//end of controller
