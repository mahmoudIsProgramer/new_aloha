<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;

class StateController extends Controller
{
  public function index(Request $request)
  {
    $states = State::when($request->search, function ($q) use ($request) {
      return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->latest()->paginate(50);
    return view('dashboard.states.index', compact('states'));
  } //end of index

  public function create()
  {
    $cities = City::all();
    return view('dashboard.states.create', compact('cities'));
  } //end of create

  public function store(Request $request)
  {

    $rules = [];
    foreach (config('translatable.locales') as $locale) {
      $rules += [$locale . '.name' => ['required', 'max:255']];
    } //end of foreach

    $request->validate($rules);
    $request_data = $request->all();
    $states = State::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.states.index');
  } //end of store
  public function show(states $states)
  {
    //
  }
  public function edit($states)
  {

    $states = State::find($states);
    $cities = City::all();
    return view('dashboard.states.edit', compact('states', 'cities'));
  } //end of edit

  public function update(Request $request,  $states)
  {
    $states = State::find($states);

    $rules = [];
    foreach (config('translatable.locales') as $locale) {
      $rules += [$locale . '.name' => ['required', 'max:255']];
    } //end of for each
    $rules += [
      'city_id' => 'required|exists:cities,id',
    ];
    $request->validate($rules);
    $request_data = $request->all();

    $states->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.states.index');
  } //end of update

  public function destroy($states)
  {
    $states = State::find($states);

    if (!$states) {
      return redirect()->back();
    }

    $states->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.states.index');
  } //end of destroy
}
