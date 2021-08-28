<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\State;
use App\Models\Regoin;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\DeliveryFormRequest;

class DeliveryController extends Controller
{

  public function index(Request $request)
  {

    $deliveries = Delivery::when($request->search, function ($q) use ($request) {

      return $q->where('name', 'like', '%' . $request->search . '%');
    })->when($request->status != null, function ($qq) use ($request) {

      return $qq->where('status', $request->status);
    })->latest()->paginate(50);

    return view('dashboard.deliveries.index', compact('deliveries'));
  } //end of index

  public function create()
  {
    $cities  = City::all();
    return view('dashboard.deliveries.create',  compact('cities'));
  } //end of create

  public function store(DeliveryFormRequest $request)
  {

    $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'deliveries/', '');
    } // end of if

    // dd($request->all());
    $delivery = Delivery::updateOrCreate(
      ['city_id' => $request->city_id],
      ['price' => $request->price]
    );

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.deliveries.index');
  } //end of store

  public function edit(Delivery $delivery)
  {
    $cities  = City::all();
    $states = State::where('city_id', $delivery->city_id)->get();
    $regoins = Regoin::where('state_id', $delivery->state_id)->get();

    return view('dashboard.deliveries.edit', compact('delivery', 'cities', 'states', 'regoins'));
  } //end of edit

  public function update(DeliveryFormRequest $request, Delivery $delivery)
  {
    $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'deliveries/', $delivery->image);
    } // end of if

    $delivery = Delivery::updateOrCreate(
      ['city_id' => $request->city_id],
      ['price' => $request->price]
    );

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.deliveries.index');
  } //end of update

  public function destroy(Delivery $delivery)
  {

    if (!$delivery) {
      return redirect()->back();
    }

    if ($delivery->image != 'default.png') {
      Storage::disk('public_uploads')->delete('deliveries/' . $delivery->image);
    } //end of if

    $delivery->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.deliveries.index');
  } //end of destroy

}//end of controller
