<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Sim;

use Illuminate\Http\Request;
use App\Traits\Models\SimTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\SimFormRequest;

class SimController  extends Controller
{
  use SimTrait;
  public function index(Request $request)
  {

    $sims = Sim::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.sims.index', compact('sims'));
  } //end of index

  public function create()
  {

    return view('dashboard.sims.create');
  } //end of create


  public function store(SimFormRequest $request)
  {
    $this->insertSim($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.sims.index');
  } //end of store

  public function edit(Sim $sim)
  {
    return view('dashboard.sims.edit', compact('sim'));
  } //end of edit

  public function update(SimFormRequest $request, Sim $sim)
  {
    $this->updateSim($sim, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.sims.index');
  } //end of update

  public function destroy(Sim $sim)
  {
    if (!$sim) {
      return redirect()->back();
    }

    $this->destroySim($sim);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.sims.index');
  } //end of destroy

}//end of controller
