<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Size;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;
use App\Traits\Models\SizeTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SizeFormRequest;

class SizeController  extends Controller
{
  use SizeTrait;
  public function index(Request $request)
  {

    $sizes = Size::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.sizes.index', compact('sizes'));
  } //end of index

  public function create()
  {

    return view('dashboard.sizes.create');
  } //end of create


  public function store(SizeFormRequest $request)
  {
    $this->insertSize($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.sizes.index');
  } //end of store

  public function edit(Size $size)
  {
    return view('dashboard.sizes.edit', compact('size'));
  } //end of edit

  public function update(SizeFormRequest $request, Size $size)
  {
    $this->updateSize($size, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.sizes.index');
  } //end of update

  public function destroy(Size $size)
  {
    if (!$size) {
      return redirect()->back();
    }

    $this->destroySize($size);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.sizes.index');
  } //end of destroy

}//end of controller
