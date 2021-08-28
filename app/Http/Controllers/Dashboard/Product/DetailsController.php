<?php

namespace App\Http\Controllers\Dashboard\Product;

use App\Models\Detail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Specification;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class DetailsController extends Controller
{
  public function index(Request $request, Product $product)
  {
    $specifications = Specification::when($product, function ($q) use ($product) {

      return $q->where('category_id', $product->category_id);
    })->latest()->get();

    foreach ($specifications as $spec) {
      $detail = Detail::updateOrCreate([
        'specification_id' => $spec->id,
        'product_id' => $product->id,
      ]);
    }

    $details = $product->details()->latest()->paginate(20);


    return view('dashboard.products.details.index', compact('details', 'product'));
  } // end of index

  public function update(Request $request, Product $product, Detail $detail)
  {

    $rules = [];

    foreach (config('translatable.locales') as $locale) {

      // $rules += [$locale . '.name' => ['required', 'max:255', Rule::unique('detail_translations', 'name')->ignore($detail->id, 'detail_id')]];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'details/', $detail->image);
    } //end of if

    if ($request->big_image) {
      $request_data['big_image'] = uploadImages($request->big_image, 'details/', $detail->big_image);
    } //end of if

    $detail->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.products.details.index', ['product' => $product->id]);
  } //end of update

  public function destroy(Product $product, Detail $detail)
  {
    if (!$detail) {
      return redirect()->back();
    }

    $detail->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.vendorDashboard.products.details.index', ['product' => $product->id]);
  } //end of destroy

}//end of controller
