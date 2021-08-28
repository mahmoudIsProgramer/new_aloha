<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Models\Complaint;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ComplaintController extends Controller
{

  public function add_complaint()
  {

    return view('customer.add_complaint');
  }

  public function add_complaint_post(Request $request)
  {

    $request_data = $request->all();
    if ($request->image) {
      $request_data['image'] = uploadImages($request->image, 'complaints/', '');
    } // end of if


    Complaint::create($request_data);
    session()->flash('success', __('site.added_successfully'));

    return redirect()->back();
  }
}
