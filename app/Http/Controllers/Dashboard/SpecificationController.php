<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Specification;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;


class SpecificationController extends Controller
{
  public function index(Request $request)
  {
    $specifications = Specification::when($request->search, function ($q) use ($request) {

      return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->latest()->paginate(20);

    return view('dashboard.specifications.index', compact('specifications'));
  } // end of index

  public function create()
  {
    $categories = Category::Active()->latest()->get();
    return view('dashboard.specifications.create', compact('categories'));
  } //end of create

  public function store(Request $request)
  {
    $rules = [
      //    'parameters'=>'required|array|min:1|exists:parameters,id',
      //  'parameters.*'=> 'integer'
    ];

    foreach (config('translatable.locales') as $locale) {

      $rules += [$locale . '.name' => ['required', 'max:255', Rule::unique('specification_translations', 'name')]];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->except(['parameters']);
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'specifications/', '');
    } //end of if
    if ($request->big_image) {
      $request_data['big_image'] = uploadImages($request->big_image, 'specifications/', '');
    } //end of if

    $specification = Specification::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.specifications.index');
  } //end of store

  public function edit(Specification $specification)
  {
    $categories = Category::Active()->latest()->get();

    return view('dashboard.specifications.edit', compact('specification', 'categories'));
  } //end of edit

  public function update(Request $request, Specification $specification)
  {

    $rules = [];

    foreach (config('translatable.locales') as $locale) {

      $rules += [$locale . '.name' => ['required', 'max:255', Rule::unique('specification_translations', 'name')->ignore($specification->id, 'specification_id')]];
    } //end of for each

    $request->validate($rules);
    $request_data = $request->except(['parameters',]);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'specifications/', $specification->image);
    } //end of if

    if ($request->big_image) {
      $request_data['big_image'] = uploadImages($request->big_image, 'specifications/', $specification->big_image);
    } //end of if

    $specification->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.specifications.index');
  } //end of update

  public function destroy(Specification $specification)
  {
    if (!$specification) {
      return redirect()->back();
    }

    $specification->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.specifications.index');
  } //end of destroy

}//end of controller
