<?php

namespace App\Http\Controllers\Frontend\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Models\FavoirteTrait;
use App\Http\Requests\FavoirteFormRequest;

class FavoirteController extends Controller
{
  use FavoirteTrait;

  public function favoirtes()
  {
    $favoirtes = authCustomer()->favoirtes;
    return view('customer.favoirtes', compact('favoirtes'));
  }

  public function toggle_favorite(FavoirteFormRequest $request)
  {
    $this->update_favorite();
    session()->flash('success', __('site.The process has successfully'));
    return redirect()->back();
  } // end of toggle_favorite

}
