<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class SubcategoryController extends Controller
{
  public function index(Request $request)
  {
    $subcategories = Subcategory::when($request->search, function ($q) use ($request) {

      return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->latest()->paginate(50);

    return view('dashboard.subcategories.index', compact('subcategories'));
  } //end of index

  public function create()
  {
    $categories = Category::all();
    return view('dashboard.subcategories.create', compact('categories'));
  } //end of create

  public function store(Request $request)
  {
    $rules = [
      'category_id' => 'required|exists:categories,id',
      'image' => validateImage(),
    ];

    foreach (config('translatable.locales') as $locale) {

      $rules += [$locale . '.name' => ['required']];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->except(['_method', '_token']);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'subcategories/', '');
    } //end of if

    $category = Subcategory::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.subcategories.index');
  } //end of store

  public function edit(Subcategory $subcategory)
  {

    $categories = Category::all();

    return view('dashboard.subcategories.edit', compact('subcategory', 'categories'));
  } //end of edit

  public function update(Request $request, Subcategory $subcategory)
  {

    $rules = [
      'category_id' => 'required|exists:categories,id',
      'image' => validateImage(),
    ];
    foreach (config('translatable.locales') as $locale) {
      $rules += [$locale . '.name' => ['required']];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->all();

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'subcategories/', $subcategory->image);
    } //end of if

    $subcategory->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.subcategories.index');
  } //end of update

  public function destroy(Subcategory $subcategory)
  {
    $subcategory->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.subcategories.index');
  } //end of destroy
}
