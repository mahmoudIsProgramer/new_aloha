<?php

namespace App\Http\Controllers\Dashboard;

use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class SubscriberController extends Controller
{
  public function __construct()
  {
    //create read update delete
    $this->middleware(['permission:read_inbox'])->only('index');
    $this->middleware(['permission:create_inbox'])->only('create');
    $this->middleware(['permission:update_inbox'])->only('edit');
    $this->middleware(['permission:delete_inbox'])->only('destroy');
  } //end of constructor
  public function index(Request $request)
  {

    if ($request->search || $request->state) {
      $subscripers = Subscriber::where('state', $request->state)
        ->orWhere('name', 'like', '%' . $request->search . '%')
        ->orWhere('email', 'like', '%' . $request->search . '%')
        ->orWhere('phone', 'like', '%' . $request->search . '%')
        ->latest()->paginate(20);
    } //end of  request check search
    else {
      $subscripers = Subscriber::latest()->paginate(20);
    }

    return view('dashboard.subscripers.index', compact('subscripers'));
  } //end of index
  public function create()
  {
    return view('dashboard.subscripers.index');
  } //end of create
  public function store(Request $request)
  {
    return view('dashboard.subscripers.index');
  } //end of store
  public function show(Subscriber $inbox)
  {
    return abort(404); //redirct to page not found
  }
  public function edit($subscriber)
  {
    $subscriber = Subscriber::find($subscriber);
    $id = $subscriber->id;

    if ($subscriber->state == 2) {

      DB::table('subscribers')
        ->where('id', $id)
        ->update(['state' => 1]);
    } elseif ($subscriber->state == 1) {
      DB::table('subscribers')
        ->where('id', $id)
        ->update(['state' => 2]);
    } else {
      dd('No Data ');
    }

    session()->flash('success', __('site.edited_successfuly'));
    return redirect()->route('dashboard.subscripers.index');
  }

  public function update(Request $request, Subscriber $subscriber)
  {
    return abort(404); //redirct to page not found
  }

  public function destroy($subscriber)
  {
    $subscriber = Subscriber::find($subscriber);
    if (!$subscriber) {
      return redirect()->back();
    }
    $subscriber->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.subscripers.index');
  } //end of destroy
}
