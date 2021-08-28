<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tax;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\UnitFormRequest;

class TaxController extends Controller
{


  protected $rules = [];

  public function validateData($id = null)
  {


    if (request()->isMethod('post')) {

      foreach (config('translatable.locales') as $locale) {
        $this->rules += [$locale . '.name' => ['required', Rule::unique('tax_translations', 'name')]];
      } // end of  for each

      $this->rules += ['status' => ['required', 'in:1,0']];
      $this->rules += ['type' => ['required', 'in:percent,value']];
      $this->rules += ['value' => ['required', 'integer', function ($attribute, $value, $fail) {
        if (request()->type == 'percent' && request()->value > 100) {
          $fail(__('Discount percent Must Not Excesed 100'));
        }
      }]];
    } elseif (request()->isMethod('put')) {

      foreach (config('translatable.locales') as $locale) {
        $this->rules += [$locale . '.name' => ['required', Rule::unique('tax_translations', 'name')->ignore($id, 'tax_id')]];
      } // end of  for each

      $this->rules += ['status' => ['required', 'in:1,0']];
      $this->rules += ['type' => ['required', 'in:percent,value']];
      $this->rules += ['value' => ['required', 'integer', function ($attribute, $value, $fail) {
        if (request()->type == 'percent' && request()->value > 100) {
          $fail(__('site.Discount percent Must Not Excesed 100'));
        }
      }]];
    }

    return $this->rules;
  }


  public function index(Request $request)
  {

    $taxes = Tax::when($request->search, function ($q) use ($request) {

      return $q->whereTranslationLike('name', '%' . $request->search . '%');
    })->when($request->status != null, function ($qq) use ($request) {

      // dd($request->status);

      return $qq->where('status', $request->status);
    })->latest()->paginate(50);

    return view('dashboard.taxes.index', compact('taxes'));
  } //end of index

  public function create()
  {
    $cities  = City::all();
    return view('dashboard.taxes.create',  compact('cities'));
  } //end of create

  public function store(Request $request)
  {
    $request->validate($this->validateData());

    $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);

    $tax = Tax::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.taxes.index');
  } //end of store

  public function edit(Tax $tax)
  {
    $cities  = City::all();
    $states = State::where('city_id', $tax->city_id)->get();
    $regoins = Regoin::where('state_id', $tax->state_id)->get();

    return view('dashboard.taxes.edit', compact('tax', 'cities', 'states', 'regoins'));
  } // end of edit

  public function update(Request $request, Tax $tax)
  {
    $request->validate($this->validateData($tax->id));


    $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);

    $tax->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.taxes.index');
  } //end of update

  public function destroy(Tax $tax)
  {

    if (!$tax) {
      return redirect()->back();
    }

    if ($tax->image != 'default.png') {
      Storage::disk('public_uploads')->delete('taxes/' . $tax->image);
    } //end of if

    $tax->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.taxes.index');
  } //end of destroy

}//end of controller
