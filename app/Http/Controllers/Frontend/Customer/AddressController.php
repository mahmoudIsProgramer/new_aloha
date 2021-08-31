<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\City;

use App\Models\State;

use App\Models\Address;
use Illuminate\Http\Request;
use App\Traits\Models\AddressTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\AddressFormRequest;

class AddressController  extends Controller
{
  use AddressTrait;

  public function create()
  {
    $cities = City::get();
    return view('frontend.customer.addresses.create', compact('cities'));
  } //end of create

  public function store(AddressFormRequest $request)
  {
    $this->insertAddress($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('customer.checkout');
  } //end of store

  public function edit(Address $address)
  {
    $cities = City::get();
    $states = State::where('city_id', $address->city_id)->get();
    return view('frontend.customer.addresses.edit', compact('address', 'cities', 'states'));
  } //end of edit

  public function update(AddressFormRequest $request, Address $address)
  {
    $this->updateAddress($address, $request);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('customer.checkout');
  } //end of update

  public function destroy(Address $address)
  {
    if (!$address) {
      return redirect()->back();
    }

    $this->destroyAddress($address);

    session()->flash('success', __('site.deleted_successfully'));

    return redirect()->back();
  } //end of destroy

}//end of controller
