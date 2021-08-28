<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Capacity;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Traits\Models\CapacityTrait;
use App\Http\Requests\Dashboard\CapacityFormRequest;

class CapacityController  extends Controller
{
  use CapacityTrait;
  public function index(Request $request)
  {

    $capacities = Capacity::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.capacities.index', compact('capacities'));
  } //end of index

  public function create()
  {

    return view('dashboard.capacities.create');
  } //end of create


  public function store(CapacityFormRequest $request)
  {
    $this->insertCapacity($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.capacities.index');
  } //end of store

  public function edit(Capacity $capacity)
  {
    return view('dashboard.capacities.edit', compact('capacity'));
  } //end of edit

  public function update(CapacityFormRequest $request, Capacity $capacity)
  {
    $this->updateCapacity($capacity, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.capacities.index');
  } //end of update

  public function destroy(Capacity $capacity)
  {
    if (!$capacity) {
      return redirect()->back();
    }

    $this->destroyCapacity($capacity);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.capacities.index');
  } //end of destroy

}//end of controller
