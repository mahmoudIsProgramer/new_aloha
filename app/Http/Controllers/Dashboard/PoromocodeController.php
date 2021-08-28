<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PromocodeFormRequest;

class PoromocodeController extends Controller
{
  protected $rules = [];


  public function index(Request $request)
  {
    $promocodes = Promocode::when($request->search, function ($q) use ($request) {
      return $q->where('code', 'like', '%' . $request->search . '%');
    })->latest()->paginate(50);

    return view('dashboard.promocodes.index', compact('promocodes'));
  } //end of index

  public function create()
  {
    return view('dashboard.promocodes.create');
  } //end of create

  public function store(PromocodeFormRequest $request)
  {
    // dd($request->all());

    // $request->validate($this->validateData());
    $request_data = $request->all();
    // $this->checkForCustomersHasOnlyOnOrder();
    $promocodes = Promocode::create($request_data);

    session()->flash('success', __('site.added_successfully'));
    return redirect()->route('dashboard.promocodes.index');
  } // end of store

  public function checkForCustomersHasOnlyOnOrder($promocode = '')
  {

    if ($promocode == null) { // create
      if (request('for_customers_has_one_order') == 1) { // if true send to customers

      }
    }

    if ($promocode) { // update
      if ($promocode->for_customers_has_one_order == '0' && request('for_customers_has_one_order') == 1 && request('status') == 1) { // if true send to customers

      }
    }
  }

  public function sendSms()
  {
    $Username = '2MqlC4zn';
    $password = 'Kzim9V2WfW';
    $language = '2'; //    1: For English 2: For Arabic 3: For Unicode
    $sender = 'MGH'; // name of web site
    $mobile = '01142117402';
    $message = 'Wellcome 2020-01-16-13-42'; // Message
    $date = '2020-01-16-13-42';
    $client = new \GuzzleHttp\Client();
    $url = "https://smsmisr.com/api/webapi/?username=$Username&password=$password&language=$language&sender=$sender&mobile=$mobile,&message=$message,&DelayUntil=$date";
    $response = $client->request('post', $url);
    $data = json_decode($response->getBody()->getContents());
    if ($data->code == 1901) {
      // dd('Goood job your mesaage set ');
      $message = $this->VerifySubscriptionContractErrorMessage($data->responseCode);
      session()->flash('error', $message);
      return redirect('customer/verify_subscription');
    } else {
      // dd('sorry ', $data->code);
    }
  }

  public function show(PromocodeFormRequest $promocode)
  {
    //
  }

  public function edit($promocodes)
  {
    $promocodes = Promocode::find($promocodes);
    return view('dashboard.promocodes.edit', compact('promocodes'));
  } //end of edit

  public function update(Request $request, Promocode $promocode)
  {

    // $request->validate($this->validateData($promocode->id));
    $request_data = $request->all();

    $promocode->update($request_data);

    session()->flash('success', __('site.updated_successfully'));
    return redirect()->route('dashboard.promocodes.index');
  } //end of update

  public function destroy($promocodes)
  {
    $promocodes = Promocode::find($promocodes);
    if (!$promocodes) {
      return redirect()->back();
    }
    $promocodes->delete();
    session()->flash('success', __('site.deleted_successfully'));
    return redirect()->route('dashboard.promocodes.index');
  } //end of destroy
}
