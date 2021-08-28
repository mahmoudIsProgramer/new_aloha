<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;

// use Illuminate\Support\Facades\Storage;
use App\Models\State;
use App\Models\Seller;
use Illuminate\Http\Request;
use App\Traits\Models\SellerTrait;
use App\Http\Controllers\Controller;
use App\Traits\Models\UploadFileTrait;
use App\Http\Requests\SellerFormRequest;

class SellerController extends Controller
{
  use SellerTrait;
  public function index(Request $request)
  {

    $sellers = Seller::whenSearch($request->search)->whenStatus($request->status)->latest()->paginate(50);

    return view('dashboard.sellers.index', compact('sellers'));
  } //end of index

  public function create()
  {
    $cities  = City::all();
    return view('dashboard.sellers.create',  compact('cities'));
  } //end of create


  public function store(SellerFormRequest $request)
  {
    $this->insertSeller($request);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.sellers.index');
  } //end of store

  public function edit(Seller $seller)
  {
    $cities  = City::all();
    $states = State::where('city_id', $seller->city_id)->get();
    // $regoins = Regoin::where('state_id', $seller->state_id)->get();

    return view('dashboard.sellers.edit', compact('seller', 'cities', 'states'));
  } //end of edit

  public function update(SellerFormRequest $request, Seller $seller)
  {
    $this->updateSeller($seller, $request);


    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.sellers.index');
  } //end of update

  public function destroy(Seller $seller)
  {
    if (!$seller) {
      return redirect()->back();
    }

    $this->destroySeller($seller);

    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.sellers.index');
  } //end of destroy

}//end of controller
