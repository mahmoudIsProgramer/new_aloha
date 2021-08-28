<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;

use App\Models\State;

// use Illuminate\Support\Facades\Storage;
use App\Models\Regoin;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Models\CustomerTrait;
use App\Traits\Models\UploadFileTrait;
use App\Http\Requests\CustomerFormRequest;

class CustomerController extends Controller
{
  use CustomerTrait;
  public function index(Request $request)
  {

    $customers = Customer::whenSearch($request->search)->whenStatus($request->status)->latest()->paginate(50);

    return view('dashboard.customers.index', compact('customers'));
  } //end of index

  public function create()
  {
    $cities  = City::all();
    return view('dashboard.customers.create',  compact('cities'));
  } //end of create


  public function store(CustomerFormRequest $request)
  {
    $this->insertCustomer($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.customers.index');
  } //end of store

  public function edit(Customer $customer)
  {
    $cities  = City::all();
    // $states = State::where('city_id', $customer->city_id)->get();
    // $regoins = Regoin::where('state_id', $customer->state_id)->get();

    return view('dashboard.customers.edit', compact('customer', 'cities'));
  } //end of edit

  public function update(CustomerFormRequest $request, Customer $customer)
  {
    $this->updateCustomer($customer, $request);


    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.customers.index');
  } //end of update

  public function destroy(Customer $customer)
  {
    if (!$customer) {
      return redirect()->back();
    }

    $this->destroyCustomer($customer);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.customers.index');
  } //end of destroy

}//end of controller
