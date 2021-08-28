<?php

namespace App\Http\Controllers\Dashboard;

// use Illuminate\Support\Facades\Storage;
use App\Models\Option;
use App\Models\Variation;
use Illuminate\Http\Request;
use App\Traits\Models\OptionTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OptionFormRequest;

class OptionController  extends Controller
{
  use OptionTrait;
  public function index(Request $request)
  {

    $options = Option::whenSearch($request->search)->latest()->paginate();

    return view('dashboard.options.index', compact('options'));
  } //end of index

  public function create()
  {
    $variations = Variation::get();

    return view('dashboard.options.create', compact('variations'));
  } //end of create


  public function store(OptionFormRequest $request)
  {
    $this->insertOption($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.options.index');
  } //end of store

  public function edit(Option $option)
  {
    $variations = Variation::get();

    return view('dashboard.options.edit', compact('option', 'variations'));
  } //end of edit

  public function update(OptionFormRequest $request, Option $option)
  {
    $this->updateOption($option, $request);


    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.options.index');
  } //end of update

  public function destroy(Option $option)
  {
    if (!$option) {
      return redirect()->back();
    }

    $this->destroyOption($option);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.options.index');
  } //end of destroy

}//end of controller
