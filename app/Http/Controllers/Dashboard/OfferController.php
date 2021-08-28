<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Brand;
use App\Models\Offer;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Dashboard\OfferFormRequest;

class OfferController extends Controller
{

  public $activeStatus = 1;


  public function index(Request $request)
  {


    $offers = Offer::when($request->search, function ($q) use ($request) {

      return $q->where('name', 'like', '%' . $request->search . '%');
    })->when($request->status != null, function ($qq) use ($request) {

      return $qq->where('status', $request->status);
    })->latest()->paginate(50);

    return view('dashboard.offers.index', compact('offers'));
  } //end of index

  public function create()
  {
    $categories = Category::where('status', $this->activeStatus)->get();
    $subcategories = Subcategory::where('status', $this->activeStatus)->get();
    $brands = Brand::where('status', $this->activeStatus)->get();
    return view('dashboard.offers.create',  compact('categories', 'subcategories', 'brands'));
  } //end of create

  public function store(OfferFormRequest $request)
  {
    $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'offers/', '');
    } // end of if

    $offer = Offer::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.offers.index');
  } //end of store

  public function edit(Offer $offer)
  {

    $categories = Category::where('status', $this->activeStatus)->get();
    $subcategories = Subcategory::where('status', $this->activeStatus)->get();
    $brands = Brand::where('status', $this->activeStatus)->get();

    return view('dashboard.offers.edit', compact('offer', 'subcategories', 'categories', 'brands'));
  } //end of edit

  public function update(OfferFormRequest $request, Offer $offer)
  {
    $request_data = $request->except(['parameters', 'password', 'password_confirmation', 'address', 'image', 'levels']);

    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'offers/', $offer->image);
    } // end of if

    $offer->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.offers.index');
  } //end of update

  public function destroy(Offer $offer)
  {

    if (!$offer) {
      return redirect()->back();
    }

    if ($offer->image != 'default.png') {
      Storage::disk('public_uploads')->delete('offers/' . $offer->image);
    } //end of if

    $offer->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.offers.index');
  } //end of destroy

}//end of controller
