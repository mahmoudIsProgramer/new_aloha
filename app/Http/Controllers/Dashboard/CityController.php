<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class CityController extends Controller
{
    //
    public function index(Request $request)
    {
        $cities = City::when($request->search, function ($q) use ($request) {
            return $q->whereTranslationLike('name', '%' . $request->search . '%');
        })->latest()->paginate(50);
        return view('dashboard.cities.index', compact('cities'));
    } //end of index

    public function create()
    {
        return view('dashboard.cities.create');
    } //end of create

    public function store(Request $request)
    {

        $rules = [];
            foreach (config('translatable.locales') as $locale) {
                $rules += [$locale . '.name' => ['required', 'max:255']];
            } //end of foreach

            $request->validate($rules);
            $request_data = $request->all();
            $cities = City::create($request_data);

            session()->flash('success', __('site.added_successfully'));
            return redirect()->route('dashboard.cities.index');
    } //end of store
    public function show(cities $cities)
    {
        //
    }
    public function edit( $cities)
    {

        $cities= City::find($cities);

        return view('dashboard.cities.edit', compact('cities'));
    } //end of edit

    public function update(Request $request,  $cities)
    {
        $cities=City::find($cities);

        $rules = [];
        foreach (config('translatable.locales') as $locale) {
            $rules += [$locale . '.name' => ['required', 'max:255' ]];

        }//end of for each

        $request->validate($rules);
        $request_data = $request->all();

        $cities->update($request_data);

        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.cities.index');

    }//end of update

    public function destroy( $cities)
    {
        $cities = City::find($cities);
        if(!$cities){
            return redirect()->back();
        }

        $cities->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.cities.index');

    } //end of destroy
}
