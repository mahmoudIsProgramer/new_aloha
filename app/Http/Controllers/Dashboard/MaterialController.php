<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Material;

use Illuminate\Http\Request;

// use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Traits\Models\MaterialTrait;
use App\Http\Requests\Dashboard\MaterialFormRequest;

class MaterialController  extends Controller
{
  use MaterialTrait;
  public function index(Request $request)
  {

    $materials = Material::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.materials.index', compact('materials'));
  } //end of index

  public function create()
  {

    return view('dashboard.materials.create');
  } //end of create


  public function store(MaterialFormRequest $request)
  {
    $this->insertMaterial($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.materials.index');
  } //end of store

  public function edit(Material $material)
  {
    return view('dashboard.materials.edit', compact('material'));
  } //end of edit

  public function update(MaterialFormRequest $request, Material $material)
  {
    $this->updateMaterial($material, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.materials.index');
  } //end of update

  public function destroy(Material $material)
  {
    if (!$material) {
      return redirect()->back();
    }

    $this->destroyMaterial($material);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.materials.index');
  } //end of destroy

}//end of controller
