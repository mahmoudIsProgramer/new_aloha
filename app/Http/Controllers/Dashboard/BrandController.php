<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Category;
use App\Models\Brand;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::when($request->search, function ($q) use ($request) {

            return $q->whereTranslationLike('name', '%' . $request->search . '%');

        })->latest()->paginate(50);

        return view('dashboard.brands.index', compact('brands'));

    }//end of index

    public function create()
    {
        $categories = Category::all();
        return view('dashboard.brands.create' , compact('categories') );

    }//end of create

    public function store(Request $request)
    {

        // dd($request->all());
        $rules = [
            'image'=>validateImage(),
        ];

        foreach (config('translatable.locales') as $locale) {

            $rules += [$locale . '.name' => ['required']];

        }//end of for each

        $request->validate($rules);
        $request_data = $request->except(['_method','_token']) ;

        if ($request->image) {
            $request_data['image'] = uploadImages( $request->image , 'brands/' , '' );
        } //end of if

        $brand = Brand::create($request_data);

        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.brands.index');

    }//end of store

    public function edit(Brand $brand)
    {

        $categories = Category::all();

        return view('dashboard.brands.edit', compact('brand' ,'categories'));
    }//end of edit

    public function update(Request $request, Brand $brand)
    {

        $rules = [
            'image'=>validateImage(),
        ];

        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required']];
        }//end of for each

        $request->validate($rules);
        $request_data = $request->all();

        if ($request->image) {
            $request_data['image'] = uploadImages( $request->image , 'brands/' , $brand->image );
        } //end of if

        $brand->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.brands.index');

    }//end of update

    public function destroy(Brand $brand)
    {
        if(!$brand){
            return redirect()->back();
        }

        $brand->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.brands.index');

    }//end of destroy
}
