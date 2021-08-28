<?php

namespace App\Http\Controllers\Dashboard;


use App\Models\Type;

use Illuminate\Http\Request;
use App\Traits\Models\TypeTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\TypeFormRequest;

class TypeController  extends Controller
{
  use TypeTrait;
  public function index(Request $request)
  {

    $types = Type::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.types.index', compact('types'));
  } //end of index

  public function create()
  {

    return view('dashboard.types.create');
  } //end of create


  public function store(TypeFormRequest $request)
  {
    $this->insertType($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.types.index');
  } //end of store

  public function edit(Type $type)
  {
    return view('dashboard.types.edit', compact('type'));
  } //end of edit

  public function update(TypeFormRequest $request, Type $type)
  {
    $this->updateType($type, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.types.index');
  } //end of update

  public function destroy(Type $type)
  {
    if (!$type) {
      return redirect()->back();
    }

    $this->destroyType($type);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.types.index');
  } //end of destroy

}//end of controller
