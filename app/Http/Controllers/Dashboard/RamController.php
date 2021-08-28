<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Ram;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;
use App\Traits\Models\RamTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RamFormRequest;

class RamController  extends Controller
{
  use RamTrait;
  public function index(Request $request)
  {

    $rams = Ram::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.rams.index', compact('rams'));
  } //end of index

  public function create()
  {

    return view('dashboard.rams.create');
  } //end of create


  public function store(RamFormRequest $request)
  {
    $this->insertRam($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.rams.index');
  } //end of store

  public function edit(Ram $ram)
  {
    return view('dashboard.rams.edit', compact('ram'));
  } //end of edit

  public function update(RamFormRequest $request, Ram $ram)
  {
    $this->updateRam($ram, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.rams.index');
  } //end of update

  public function destroy(Ram $ram)
  {
    if (!$ram) {
      return redirect()->back();
    }

    $this->destroyRam($ram);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.rams.index');
  } //end of destroy

}//end of controller
