<?php

namespace App\Http\Controllers\Frontend\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PaymentController extends Controller
{


  public function callback_response(Request $request)
  {
    // dd(request()->merchantTransactionId);
    // dd(session('merchantTransactionId'));
    $responseData = $this->getPaymentStatusCode();
    // dd($responseData);

    $paymentMessage = $this->updatePaymentStatus($responseData);

    // removeSession();
    return view('customer.paymentStatusView', compact('paymentMessage'));
  }
}
