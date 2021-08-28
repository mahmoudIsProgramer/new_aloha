<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Inbox;
use App\Mail\QuickMessage;
use App\Exports\InboxExport;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;


class InboxController extends Controller
{

  public function __construct()
  {
    //create read update delete
    $this->middleware(['permission:read_inbox'])->only('index');
    $this->middleware(['permission:create_inbox'])->only('create');
    $this->middleware(['permission:update_inbox'])->only('edit');
    $this->middleware(['permission:delete_inbox'])->only('destroy');
  } // end of constructor

  public function index(Request $request)
  {

    $inboxs = Inbox::when($request->state, function ($q) use ($request) {
      return $q->where('state', $request->state);
    })->when($request->search, function ($q) use ($request) {
      return $q->Where('email', 'like', '%' . $request->search . '%');
    })->latest()->paginate(50);

    return view('dashboard.inbox.index', compact('inboxs'));
  } //end of index

  public function create()
  {
    return view('dashboard.inbox.create');
  } //end of create

  public function store(Request $request)
  {

    $request->validate([
      'name' => 'required',
      'email' => 'required|email',
      'body' => 'required',
    ]);

    $name = $request->input('name');
    $email = $request->input('email');
    $phone = $request->input('phone');
    $body = $request->input('body');

    Mail::send('quick_message.view', array(
      'name' => $name,
      'email' => $email,
      'phone' => $phone,
      'body' => $body,

    ), function ($message) use ($request) {
      $message->to($request->input('email'), $request->input('name'))->subject('معارض اي بيكر');
      $message->from('Tarekadmin@cccc.com');
    });

    session()->flash('success', __('site.added_successfuly'));
    return redirect()->route('dashboard.index');
  } //end of store

  public function show(Inbox $inbox)
  {
    return abort(404); //redirct to page not found
  }

  public function edit(Inbox $inbox)
  {
    if ($inbox->state == 2) {
      Inbox::where('id', $inbox->id)
        ->update(['state' => 1]);
    } else {
      Inbox::where('id', $inbox->id)
        ->update(['state' => 2]);
    }
    session()->flash('success', __('site.edited_successfuly'));
    return redirect()->route('dashboard.inbox.index');
  }

  public function update(Request $request, Inbox $inbox)
  {
    return abort(404); //redirct to page not found
  }

  public function destroy($inbox)
  {
    $inbox = Inbox::find($inbox);
    if (!$inbox) {
      return redirect()->back();
    }
    $inbox->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.inbox.index');
  } //end of destroy

  public function export_inbox()
  {
    return Excel::download(new OrdersExport, 'InboxData.xlsx');
  }
} //the end of service provider
