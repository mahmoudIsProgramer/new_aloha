<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class CategoryController extends Controller
{
  public function index(Request $request)
  {
    $categories = Category::when($request->search, function ($q) use ($request) {

      return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->latest()->paginate(50);

    return view('dashboard.categories.index', compact('categories'));
  } //end of index

  public function create()
  {
    $categories = Category::latest()->get();

    return view('dashboard.categories.create', compact('categories'));
  } //end of create

  public function store(Request $request)
  {
    $rules = [
      //    'parameters'=>'required|array|min:1|exists:parameters,id',
      //  'parameters.*'=> 'integer'
    ];

    foreach (config('translatable.locales') as $locale) {

      $rules += [$locale . '.name' => ['required', 'max:255', Rule::unique('category_translations', 'name')]];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->except(['parameters']);
    $request_data['parent_id'] = empty($request_data['parent_id']) ? 0 : $request_data['parent_id'];
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'categories/', '');
    } //end of if

    $category = Category::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.categories.index');
  } //end of store

  public function edit(Category $category)
  {
    $categories = Category::where('id',"!=", $category->id)->latest()->get();

    return view('dashboard.categories.edit', compact('category', 'categories'));
  } //end of edit

  public function update(Request $request, Category $category)
  {

    $rules = [];

    foreach (config('translatable.locales') as $locale) {

      $rules += [$locale . '.name' => ['required', 'max:255', Rule::unique('category_translations', 'name')->ignore($category->id, 'category_id')]];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'categories/', $category->image);
    } //end of if

    $category->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.categories.index');
  } //end of update

  public function destroy(Category $category)
  {
    if (!$category) {
      return redirect()->back();
    }

    $category->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.categories.index');
  } //end of destroy

}//end of controller
