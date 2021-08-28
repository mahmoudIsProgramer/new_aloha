<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class SliderController extends Controller
{

  public function index(Request $request)
  {
    $sliders = Slider::when($request->search, function ($q) use ($request) {
      return $q->whereTranslationLike('title', '%' . $request->search . '%');
    })->latest()->paginate(50);
    return view('dashboard.sliders.index', compact('sliders'));
  } //end of index

  public function create()
  {
    return view('dashboard.sliders.create');
  } //end of create

  public function store(Request $request)
  {
    $rules = [];

    $rules += [
      'image' => 'image:mimes:jpeg,bmp,png|max:2048',
      'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    foreach (config('translatable.locales') as $locale) {

      // $rules += [$locale . '.title' => ['required',validateShortText()]];

    } //end of foreach

    $request->validate($rules);
    $request_data = $request->all();

    if ($request->image) {

      $request_data['image'] = uploadImages($request->image, 'slider/', '');
    } //end of if

    Slider::create($request_data);
    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.sliders.index');
  } //end of store

  public function show(Slider $slider)
  {
    //
  }

  public function edit(Slider $slider)
  {
    return view('dashboard.sliders.edit', compact('slider'));
  } //end of edit

  public function update(Request $request, Slider $slider)
  {
    $rules = [];
    $rules += [
      'image' => 'image:mimes:jpeg,bmp,png|max:2048',
      'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

    ];

    foreach (config('translatable.locales') as $locale) {
      // $rules += [$locale . '.title' => ['required',validateShortText()]];
    } // end of for each



    $request->validate($rules);

    $request_data = $request->except(['image',]);

    if ($request->image) {
      //check if img not empty remove the current img to replace the new img
      if ($slider->image != 'default.png') {
        Storage::disk('public_uploads')->delete('/' . $slider->image);
      } //end of inner if


      $request_data['image'] = uploadImages($request->image, 'slider/', $slider->image);
    } //end of external if


    $slider->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.sliders.index');
  } //end of update

  public function destroy(Slider $slider)
  {
    if (!$slider) {
      return redirect()->back();
    }
    if ($slider->image != 'default.png') {
      Storage::disk('public_uploads')->delete('/slider/' . $slider->image);
    } //end of if
    $slider->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.sliders.index');
  } //end of destroy
}
