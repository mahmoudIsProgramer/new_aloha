<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\Subsubcategory;
use App\Http\Controllers\Controller;

class SubsubcategoryController extends Controller
{
  public function index(Request $request)
  {
    $subsubcategories = Subsubcategory::when($request->search, function ($q) use ($request) {

      return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->latest()->paginate(20);

    return view('dashboard.subsubcategories.index', compact('subsubcategories'));
  } //end of index

  public function create()
  {
    $subcategories = Subcategory::Active()->get();
    return view('dashboard.subsubcategories.create', compact('subcategories'));
  } //end of create

  public function store(Request $request)
  {
    $rules = [
      'subcategory_id' => 'required|exists:subcategories,id',
      'image' => validateImage(),
    ];

    foreach (config('translatable.locales') as $locale) {

      $rules += [$locale . '.name' => ['required']];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->except(['_method', '_token']);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'subsubcategories/', '');
    } //end of if

    if ($request->big_image) {
      $request_data['big_image'] = uploadImages($request->big_image, 'subsubcategories/', '');
    } //end of if


    $category = Subsubcategory::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.subsubcategories.index');
  } // end of store


  public function duplicate(Subsubcategory $subsubcategory)
  {
    // dd($subsubcategory);
    $item = $subsubcategory;

    $clone = $item->replicate();
    $clone->push();


    $update = $clone->update([
      'ar' => [
        'name' => $item->translate('ar')->name . ' copy',
        // 'description'  => $item->description,
        // 'short_description' => $item->short_description,
      ],
      'en' => [
        'name' => $item->translate('en')->name . ' copy',
        // 'description'  => $item->description,
        // 'short_description' => $item->short_description,
      ],
    ]);
    return redirect()->back();
  } //end of duplicate



  public function edit(Subsubcategory $subsubcategory)
  {
    $subcategories = subcategory::Active()->get();

    // dd($subsubcategory);
    return view('dashboard.subsubcategories.edit', compact('subsubcategory', 'subcategories'));
  } // end of edit

  public function update(Request $request, Subsubcategory $subsubcategory)
  {

    $rules = [
      'subcategory_id' => 'required|exists:subcategories,id',
      'image' => validateImage(),
    ];
    foreach (config('translatable.locales') as $locale) {
      $rules += [$locale . '.name' => ['required']];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->all();

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'subsubcategories/', $subsubcategory->image);
    } //end of if
    if ($request->big_image) {
      $request_data['big_image'] = uploadImages($request->big_image, 'subsubcategories/', $subsubcategory->big_image);
    } //end of if


    $subsubcategory->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.subsubcategories.index');
  } //end of update

  public function destroy(Subsubcategory $subsubcategory)
  {
    $subsubcategory->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.subsubcategories.index');
  } //end of destroy
}
