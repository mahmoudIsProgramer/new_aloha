<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;


class BannerController extends Controller
{

  public function index(Request $request)
  {
    $banners = Banner::when($request->search, function ($q) use ($request) {
      return $q->whereTranslationLike('title', '%' . $request->search . '%');
    })->latest()->paginate(50);
    return view('dashboard.banners.index', compact('banners'));
  } //end of index

  public function create()
  {
    return view('dashboard.banners.create');
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

      $request_data['image'] = uploadImages($request->image, 'banners/', '');
    } //end of if

    Banner::create($request_data);
    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.banners.index');
  } //end of store

  public function show(Banner $banners)
  {
    //
  }

  public function edit(Banner $banner)
  {
    return view('dashboard.banners.edit', compact('banner'));
  } //end of edit

  public function update(Request $request, Banner $banner)
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
      if ($banner->image != 'default.png') {
        Storage::disk('public_uploads')->delete('/' . $banner->image);
      } //end of inner if

      $request_data['image'] = uploadImages($request->image, 'banners/', $banner->image);
    } //end of external if


    $banner->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.banners.index');
  } //end of update

  public function destroy(Banner $banner)
  {
    if (!$banner) {
      return redirect()->back();
    }
    if ($banner->image != 'default.png') {
      Storage::disk('public_uploads')->delete('banners/' . $banner->image);
    } //end of if
    $banner->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.banners.index');
  } //end of destroy
}
