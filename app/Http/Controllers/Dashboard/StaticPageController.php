<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\StaticPage;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class StaticPageController extends Controller
{

  public function index(Request $request)
  {
    $staticPages = StaticPage::when($request->search, function ($q) use ($request) {
      return $q->whereTranslationLike('title', '%' . $request->search . '%');
    })->latest()->paginate(50);
    return view('dashboard.staticPages.index', compact('staticPages'));
  } //end of index
  public function create()
  {
    return view('dashboard.staticPages.create');
  } //end of create
  public function store(Request $request)
  {

    // validateShortText
    $rules = [];

    $rules += [
      'image' => 'image:mimes:jpeg,bmp,png|max:2048',
      'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];



    $request->validate($rules);
    $request_data = $request->all();

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'staticPages/', '');
    } //end of if

    StaticPage::create($request_data);
    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.staticPages.index');
  } //end of store

  public function show(StaticPage $staticPage)
  {
    //
  }

  public function edit(StaticPage $staticPage)
  {
    return view('dashboard.staticPages.edit', compact('staticPage'));
  } //end of edit

  public function deleteImage(StaticPage $staticPage)
  {

    Storage::disk('public_uploads')->delete('staticPage/' . $staticPage->image);
    $staticPage->update(['image' => null]);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->back();
  }

  public function update(Request $request, StaticPage $staticPage)
  {
    $rules = [];


    $rules += [
      'image' => 'image:mimes:jpeg,bmp,png|max:2048',
      'images.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ];

    foreach (config('translatable.locales') as $locale) {
      $rules += [$locale . '.title' => ['required', validateShortText()]];
    } // end of for each


    $request->validate($rules);

    $request_data = $request->except(['image',]);

    if ($request->image) {
      //check if img not empty remove the current img to replace the new img
      if ($staticPage->image != 'default.png') {
        Storage::disk('public_uploads')->delete('/' . $staticPage->image);
      } //end of inner if
      $request_data['image'] = uploadImages($request->image, 'staticPage/', $staticPage->image);
    } //end of external if

    $staticPage->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.staticPages.index');
  } //end of update

  public function destroy(StaticPage $staticPage)
  {
    if (!$staticPage) {
      return redirect()->back();
    }

    if ($staticPage->image != 'default.png') {
      Storage::disk('public_uploads')->delete('/staticPage/' . $staticPage->image);
    } //end of if
    $staticPage->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.staticPages.index');
  } //end of destroy
}
