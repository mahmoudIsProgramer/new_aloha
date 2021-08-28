<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Complaint;
use App\Mail\QuickMessage;
use App\Exports\InboxExport;
use Illuminate\Http\Request;

use App\Exports\OrdersExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class ComplaintController extends Controller
{

  public function __construct()
  {
  } // end of constructor

  public function index(Request $request)
  {

    $complaints = Complaint::when($request->state, function ($q) use ($request) {
      return $q->where('state', $request->state);
    })->when($request->search, function ($q) use ($request) {
      return $q->Where('description', 'like', '%' . $request->search . '%');
    })->with('customer')->latest()->paginate(15);

    return view('dashboard.complaints.index', compact('complaints'));
  } //end of index

  public function edit(Complaint $complaint)
  {
    if ($complaint->state == 2) {
      Complaint::where('id', $complaint->id)
        ->update(['state' => 1]);
    } else {
      Complaint::where('id', $complaint->id)
        ->update(['state' => 2]);
    }
    session()->flash('success', __('site.edited_successfuly'));
    return redirect()->route('dashboard.complaints.index');
  }


  public function destroy($inbox)
  {
    if (!$inbox) {
      return redirect()->back();
    }

    $inbox = Complaint::find($inbox);
    $inbox->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.complaints.index');
  } //end of destroy

  public function export_inbox()
  {
    return Excel::download(new OrdersExport, 'InboxData.xlsx');
  }
} //the end of service provider
