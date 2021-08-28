<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Color;

// use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Traits\Models\ColorTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ColorFormRequest;

class ColorController  extends Controller
{
  use ColorTrait;
  public function index(Request $request)
  {

    $colors = Color::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.colors.index', compact('colors'));
  } //end of index

  public function create()
  {

    return view('dashboard.colors.create');
  } //end of create


  public function store(ColorFormRequest $request)
  {
    $this->insertColor($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.colors.index');
  } //end of store

  public function edit(Color $color)
  {
    return view('dashboard.colors.edit', compact('color'));
  } //end of edit

  public function update(ColorFormRequest $request, Color $color)
  {
    $this->updateColor($color, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.colors.index');
  } //end of update

  public function destroy(Color $color)
  {
    if (!$color) {
      return redirect()->back();
    }

    $this->destroyColor($color);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.colors.index');
  } //end of destroy

}//end of controller
