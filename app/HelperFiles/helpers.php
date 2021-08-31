<?php

use App\Models\Product;
use App\Models\Tax;
use App\Models\Background;


if (!function_exists('sliderPositions')) {
  function sliderPositions()
  {
    return [
      'main',
      'right',
      'bottom',
    ];
  }
}

if (!function_exists('bannerLocations')) {
  function bannerLocations()
  {
    return ['topHome', 'middleHome', 'bottomHome'];
  }
}

if (!function_exists('background')) {
  function background($key = '')
  {
    $backgroud = Background::where('key', $key)->first();
    return ($backgroud && $backgroud->image) ? $backgroud->image_path : asset('uploads/backgrounds/default.jpg');
  }
}

if (!function_exists('paymentMethods')) {
  function paymentMethods($type = null)
  {
    if ($type == 'str') {
      return 'cashOnDelivery,payOnline';
    }

    return ['payOnline', 'wallet'];
    // return ['cacheOnDelivery', 'payOnline', 'wallet'];
  }
}

if (!function_exists('getProDiscountValue')) {
  function getProDiscountValue()
  {
    return session()->get('coupon') ? session()->get('coupon')['discount'] : 0;
  }
}

if (!function_exists('getProDiscountName')) {
  function getProDiscountName()
  {
    return session()->get('coupon') ? session()->get('coupon')['name'] : '';
  }
}

if (!function_exists('maxPrice')) {
  function maxPrice()
  {
    return Product::max('selling_price') ?? 50000;
  }
}

if (!function_exists('stepValue')) {
  function stepValue()
  {
    return (int)(Product::max('selling_price') / 10) ?? 20;
  }
}

if (!function_exists('tables')) {
  function tables()
  {
    return ['users', 'customers', 'sellers'];
  }
}

if (!function_exists('perPageNumbers')) {
  function perPageNumbers()
  {
    return [8, 16, 32, 64];
  }
}

if (!function_exists('sortType')) {
  function sortType()
  {
    return ['nameAZ', 'nameZA', 'priceHL', 'priceLH'];
  }
}

if (!function_exists('wallet_operations')) {
  function wallet_operations($type = 'arr')
  {
    if ($type == 'string') {
      return 'withdraw,purchase';
    }
    return ['withdraw', 'purchase'];
  }
}

if (!function_exists('fillAllRequiredData')) {
  function fillAllRequiredData()
  {
    return "<span style='color:red'>" . __('site.please fill all required fields') . "</span>";
  }
}

if (!function_exists('setPreviousUrl')) {
  function setPreviousUrl()
  {

    $urlPrevious = url()->previous();
    $urlBase = url()->to('/');

    // Set the previous url that we came from to redirect to after successful login but only if is internal
    if (($urlPrevious != $urlBase . '/login') && (substr($urlPrevious, 0, strlen($urlBase)) === $urlBase)) {
      session()->put('url.intended', $urlPrevious);
    }


    return true;
  }
}


if (!function_exists('size_slider')) {
  function size_slider()
  {
    $size = "Recommended Dimension=   1920px X 550px";
    return $size;
  }
}

if (!function_exists('size_')) {
  function size_()
  {
    $size = "Recommended Dimension=   350 X 244 px";
    return $size;
  }
}
if (!function_exists('size_categories')) {
  function size_categories()
  {
    $size = "Recommended Dimension=   350 X 244 px";
    return $size;
  }
}


if (!function_exists('size_main_product')) {
  function size_main_product()
  {
    $size = "Recommended Dimension=    250 X 300 px";
    return $size;
  }
}
if (!function_exists('size_product_sliders')) {
  function size_product_sliders()
  {
    $size = "Recommended Dimension=    775 X 1000 px";
    return $size;
  }
}

if (!function_exists('size_news')) {
  function size_news()
  {
    $size = "Recommended Dimension=   768 X 988 px";
    return $size;
  }
}

if (!function_exists('size_about')) {
  function size_about()
  {
    $size = "Recommended Dimension=   1000 X 591 px";
    return $size;
  }
}


if (!function_exists('firstName')) {
  function firstName()
  {

    $name = explode(' ', authCustomer()->full_name);
    $firstName = __('site.Welcome') . ',' . $name[0];

    return $firstName;
  }
}

if (!function_exists('superAdminEmail')) {
  function superAdminEmail()
  {
    return "info@bsupplyhub.com";
    // return "sendmail1@brandnmake.com" ;
  }
}

if (!function_exists('senderName')) {
  function senderName()
  {
    return "aloha";
    // return "sendmail1@brandnmake.com" ;
  }
}

if (!function_exists('mainSubject')) {
  function mainSubject()
  {
    return __('site.aloha');
  }
}

if (!function_exists('orderStatusMessage')) {
  function orderStatusMessage($status)
  {

    $msg = '';

    if ($status == 'pendding') {
      // $msg='تم انشاء الطلب الخاص بك';
      $msg = "your order is pendding";
    }

    if ($status == 'inShipment') {
      // $msg='يتم الان اعداد الطلب الخاص بك';
      $msg = "your order  in Shipment";
    }


    if ($status == 'onDelivery') {
      // $msg='الطلب الخاص بك في الطريق اليك';
      $msg = "your order on Delivery";
    }
    if ($status == 'completed') {
      // $msg=' تم اتمام الطلب الخاص بك  بنجاح';
      $msg = "your order is  completed";
    }

    if ($status == 'canceled') {
      // $msg=' تم الغاء الطلب الخاص بك   ';
      $msg = "your order is  canceled";
    }

    return $msg;
  }
}

if (!function_exists('orderStatusMessage')) {
  function requestPriceOrderStatusMessage($status)
  {

    $msg = '';

    if ($status == 'pendding') {
      // $msg='تم انشاء الطلب الخاص بك';
      $msg = __('site.your order in  pendding cart waite to completing');
    }

    if ($status == 'done') {
      // $msg='يتم الان اعداد الطلب الخاص بك';
      $msg = __("site.your order is done successfully");
    }

    return $msg;
  }
}

if (!function_exists('orderStatus')) {
  function orderStatus()
  {
    return ["pendding", "inShipment", "onDelivery", "completed", "canceled"];
  }
}

if (!function_exists('orderStatusAsString')) {
  function orderStatusAsString()
  {
    return "pendding,inShipment,onDelivery,completed,canceled";
  }
}


if (!function_exists('getCurrencies')) {
  function getCurrencies()
  {
    return ['Dolar', 'LE', 'SAR'];
  }
}

if (!function_exists('getCustomer')) {
  function getCustomer()
  {
    return auth()->guard('customer')->user() ?? auth()->guard('customer-api')->user();
  }
}

// #multiple upload image
// if (!function_exists('MultipleUploadImages')) {
//   function MultipleUploadImages($requests, $path)
//   {

//     $data = [];
//     foreach ($requests as  $attach) {

//       Image::make($attach)
//         ->resize(630, null, function ($constraint) {
//           $constraint->aspectRatio();
//         })
//         ->save(public_path('uploads/' . $path . $attach->hashName()));
//       $data[] = $attach->hashName();


//       // $fileName = time().rand(1,100).'.'.$attach->getClientOriginalExtension();

//       // $attach->move( public_path('uploads/'.$path ) , $fileName );

//       // $data[] = $fileName;
//     }
//     return $data;
//   }
// }

if (!function_exists('getModels')) {
  function getModels()
  {

    return array_keys(config('asidebar_links.modules'));
  }
}

if (!function_exists('getCurrencyBlade')) {
  function getCurrencyBlade()
  {

    $html = __('site.' . config('site_options.currency'));

    return $html;
  }
}

if (!function_exists('activeColumn')) {
  function activeColumn($active)
  {

    $html = '';
    if ($active == 1) {
      $html = "<small class='btn-xs btn-success'>" . __('site.Active') . "</small>";
    } else {
      $html = "<small class='btn-xs btn-danger'>" . __('site.In-Active') . "</small>";
    }
    return $html;
  }
}


if (!function_exists('paymentStatus')) {
  function paymentStatus($active, $payment_method = '')
  {

    if ($payment_method == 'cacheOnDelivery' || $payment_method == 'premium')
      return '';


    $html = '';
    if ($active == 1) {
      $html = "<small class='btn-xs btn-success'>" . __('site.Success') . "</small>";
    } else {
      $html = "<small class='btn-xs btn-danger'>" . __('site.Failed') . "</small>";
    }
    return $html;
  }
}

if (!function_exists('activeTab')) {
  function activeTab($tab)
  {
    // dd(session()->get('activeTab' ));
    if (session()->get('activeTab')  == $tab) {
      return 'active';
    }
  }
}

if (!function_exists('DeleteMultipleImage')) {
  function DeleteMultipleImage($type_id, $type, $folder = '')
  {
    $files_names  = DB::table('attachments')->where('type_id', $type_id)->where('type', $type)->pluck('image')->toArray();

    foreach ($files_names  as  $file) {
      DeleteImage(public_path('uploads/' . $folder . '/' . $file));
    }
    DB::table('attachments')->where('type_id', $type_id)->where('type', $type)->delete();
  }
}

if (!function_exists('DeleteImage')) {
  function DeleteImage($DeleteFileWithName)
  {
    if (file_exists($DeleteFileWithName)) {
      \File::delete($DeleteFileWithName);
    }
  }
}

#upload image
if (!function_exists('uploadImages')) {
  function uploadImages($req, $path, $deleteOldImage)
  {
    // delete old image
    if ($deleteOldImage != 'default.png') {
      DeleteImage(public_path('uploads/' . $path . $deleteOldImage));
    } //end of inner if

    Image::make($req)
      // ->resize(300, null, function ($constraint) {
      //     $constraint->aspectRatio();
      // })
      ->save(public_path('uploads/' . $path . $req->hashName()));
    return   $req->hashName();
  }
}

#validate helper function
if (!function_exists('validateImage')) {
  function validateImage($ext = null)
  {
    if ($ext == null) {
      return 'mimes:jpg,jpeg,png,bmp,JPG,JPEG,PNG,BMP';
    } else {
      return 'mimes:' . $ext;
    }
  }
}

if (!function_exists('validateShortText')) {
  function validateShortText($ext = null)
  {
    return "max:255";
    // return "string|min:3|max:255";
  }
}

if (!function_exists('image_path')) {
  function image_path($folder, $image)
  {
    return asset('uploads/' . $folder . '/' . $image);
  }
}

if (!function_exists('LogoutAllGuards')) {
  function LogoutAllGuards()
  {
    $guards =  [null, 'customer', 'seller'];
    foreach ($guards as $guard) {
      \Auth::guard($guard)->logout();
    }
  }

  return true;
}
