<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{

  public function index(Request $request)
  {
    $abouts = About::when($request->search, function ($q) use ($request) {
      return $q->whereTranslationLike('title', '%' . $request->search . '%');
    })->latest()->paginate(50);
    return view('dashboard.abouts.index', compact('abouts'));
  } //end of abouts


  public function create()
  {
    return view('dashboard.abouts.create');
  } //end of create


  public function store(Request $request)
  {

    $rules = [];
    foreach (config('translatable.locales') as $locale) {
      $rules += [$locale . '.title' => ['required', Rule::unique('about_translations', 'title')]];
    } //end of for each

    $rules += [
      // 'image' => 'required|image:mimes:jpeg,bmp,png|max:2048',
      // 'active' => 'required|in:0,1',
    ];

    $request->validate($rules);
    $request_data = $request->all();

    // if ($request->image) {
    //     Image::make($request->image)
    //         ->resize(300, null, function ($constraint) {
    //             $constraint->aspectRatio();
    //         })
    //         ->save(public_path('uploads/about/' . $request->image->hashName()));
    //     $request_data['image'] = $request->image->hashName();
    // } //end of if


    if ($request->active == 1) {
      $affected = DB::table('abouts')->update(['active' => 0]);
    }

    About::create($request_data);
    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.abouts.index');
  } //end of store

  public function show(About $about)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\About  $about
   * @return \Illuminate\Http\Response
   */
  public function edit(About $about)
  {
    return view('dashboard.abouts.edit', compact('about'));
  } //end of edit

  public function update(Request $request, About $about)
  {

    $rules = [];

    foreach (config('translatable.locales') as $locale) {

      $rules += [$locale . '.title' => ['required', Rule::unique('about_translations', 'title')->ignore($about->id, 'about_id')]];
    } //end of for each
    $rules += [
      'image' => 'image:mimes:jpeg,bmp,png|max:2048',
      // 'active' => 'required|in:0,1',

    ];
    $request->validate($rules);

    $request_data = $request->except(['image',]);

    if ($request->image) {
      //check if img not empty remove the current img to replace the new img
      if ($about->image != 'default.png') {
        Storage::disk('public_uploads')->delete('/' . $about->image);
      } //end of inner if
      Image::make($request->image)
        ->resize(630, null, function ($constraint) {
          $constraint->aspectRatio();
        })
        ->save(public_path('uploads/about/' . $request->image->hashName()));

      $request_data['image'] = $request->image->hashName();
    } //end of external if

    if ($request->active == 1) {
      $affected = DB::table('abouts')->update(['active' => 0]);
    }

    $about->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.abouts.index');
  } //end of update

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\About  $about
   * @return \Illuminate\Http\Response
   */
  public function destroy($about)
  {
    $about = About::find($about);
    if (!$about) {
      return redirect()->back();
    }
    if ($about->image != 'default.png') {
      Storage::disk('public_uploads')->delete('about/' . $about->image);
    } //end of if
    $about->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.abouts.index');
  } //end of destroy
}
