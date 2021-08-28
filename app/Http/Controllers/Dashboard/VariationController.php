<?php

namespace App\Http\Controllers\Dashboard;

use App\Variation;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;
use App\Traits\Models\VariationTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\VariationFormRequest;

class VariationController  extends Controller
{
  use VariationTrait;
  public function index(Request $request)
  {

    $variations = Variation::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.variations.index', compact('variations'));
  } //end of index

  public function create()
  {

    return view('dashboard.variations.create');
  } //end of create


  public function store(VariationFormRequest $request)
  {
    $this->insertVariation($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.variations.index');
  } //end of store

  public function edit(Variation $variation)
  {
    return view('dashboard.variations.edit', compact('variation'));
  } //end of edit

  public function update(VariationFormRequest $request, Variation $variation)
  {
    $this->updateVariation($variation, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.variations.index');
  } //end of update

  public function destroy(Variation $variation)
  {
    if (!$variation) {
      return redirect()->back();
    }

    $this->destroyVariation($variation);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.variations.index');
  } //end of destroy

}//end of controller
