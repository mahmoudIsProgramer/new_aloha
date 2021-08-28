<?php

namespace App\Http\Controllers\AuthCustomer;

use Socialite;
use App\Models\Customer;
// use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator, Redirect, Response, File;

class CustomerSocialController extends Controller
{
  public function redirect($provider)
  {
    // setPreviousUrl();

    return Socialite::driver($provider)->redirect();
  }

  public function callback($provider)
  {
    $getInfo = Socialite::driver($provider)->user();
    $user = $this->createUser($getInfo, $provider);

    auth()->guard('customer')->login($user, true);

    // auth()->guard('customer')->loginUsingId($user['id'],true );
    return redirect(session()->get('url.intended', '/'));
    return redirect()->route('home');
  }
  function createUser($getInfo, $provider)
  {

    #not exist with provider_id
    $customer = Customer::where('provider_id', $getInfo->id)->first();

    // if($customer){
    //     if($customer->status==0){
    //         return redirect()->route('home');
    //     }
    // }

    if (!$customer) {

      #not exist with email
      $customer = Customer::where('email', $getInfo->email)->first();
      if (!$customer) {

        $customer = Customer::create([
          'full_name'     => $getInfo->name,
          'email' => $getInfo->email ?? $getInfo->id . '@social.com',
          'provider' => $provider,
          'provider_id' => $getInfo->id,
          // 'promocode' => $pro,
        ]);

      }
    }



    return $customer;
  }
}

// public function CheckEmailUniqe( $social_id , $email ){

//     $customer = Customer::where('social_id',$social_id )->first();

//     if($customer == null ){

//         $customer = Customer::where('email',$email )->first();

//         if($customer ){
//             return false ;
//         }

//     }
//     return true ;
// }
