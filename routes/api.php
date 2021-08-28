<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

// composer require laravel/passport  "7.5.1"

Route::group(
  [
    'namespace' => "API", 'middleware' => 'localization',
  ],
  function () {

    Route::post('social_login', 'Customer\AuthController@social_login');
    Route::post('login', 'Customer\AuthController@login');
    Route::post('signupCustomer', 'Customer\AuthController@signupCustomer');
    Route::post('customer/productDetails', 'PublicController@productDetails')->name('productDetails');

    // Route::post('/cities', 'PublicController@cities')->name('cities');
    // Route::post('/states', 'PublicController@states')->name('states');
    // Route::post('/regoins', 'PublicController@regoins')->name('regoins');

    Route::post('/categories', 'PublicController@categories')->name('categories');
    Route::post('/offers', 'PublicController@offers')->name('offers');
    Route::post('/searchProduct', 'PublicController@searchProduct')->name('searchProduct');
    Route::post('/bestSelling', 'PublicController@bestSelling')->name('bestSelling');
    Route::post('/similarProducts', 'PublicController@similarProducts')->name('similarProducts');
    Route::post('/hotDeal', 'PublicController@hotDeal')->name('hotDeal');
    Route::post('/staticPages', 'PublicController@staticPages')->name('staticPages');
    Route::post('/contactUs', 'PublicController@contactUs')->name('contactUs');
    Route::post('/deliveries', 'PublicController@deliveries')->name('deliveries');
    Route::post('test_pay', 'PublicController@test_pay');
    Route::post('session_pay', 'PublicController@session_pay');

    // Route::post('/blogs', 'NewsController@blogs')->name('blogs');
    Route::post('/sliders', 'PublicController@sliders')->name('sliders');

    Route::group(['namespace' => "Customer", 'prefix' => 'customer/', 'middleware' => 'auth:customer-api'], function () {

      Route::post('editCustomerProfile', 'AuthController@editCustomerProfile');
      // Route::post('cancelOrder', 'OrderController@cancelOrder');
      Route::post('setReview', 'CustomerController@setReview');
      // Route::post('order_details', 'OrderController@order_details');

      Route::post('getPromocodeDiscount', 'OrderController@getPromocodeDiscount')->name('getPromocodeDiscount');
      Route::post('getWinWheelPrize', 'OrderController@getWinWheelPrize')->name('getWinWheelPrize');

      // start Favoirtes
      Route::post('/addFavorite', 'FavoirteController@addFavorite')->name('addFavorite');
      Route::post('/removeFavorite', 'FavoirteController@removeFavorite')->name('removeFavorite');
      Route::post('/favoirtes', 'FavoirteController@favoirtes')->name('favoirtes');
      // end Favoirtes

      // start Cart
      Route::post('/addToCart', 'CartController@addToCart')->name('addToCart');
      Route::post('/removeFromCart', 'CartController@removeFromCart')->name('removeFromCart');
      Route::post('/carts', 'CartController@carts')->name('carts');
      // end Cart

      #orders
      Route::post('makeOrder', 'OrderController@makeOrder');
      Route::post('updateOrderStatus', 'OrderController@updateOrderStatus');
      Route::post('orders', 'OrderController@orders');
      Route::post('getOrderTaxes', 'OrderController@getOrderTaxes');
      #mob payment
      Route::post('payment_mob', 'OrderController@payment_mob');

      #gifts
      Route::post('gifts', 'GiftController@gifts');
      Route::post('getGift', 'GiftController@getGift');

      Route::get('logout', 'AuthController@logout');
      Route::post('changePassword', 'AuthController@changePassword');
      Route::post('updateFirebaseToken', 'AuthController@updateFirebaseToken');
      Route::post('profile', 'AuthController@profile');
    });
  }
);

Route::group([
  'namespace' => 'API\Customer',
  'middleware' => 'api',
  'prefix' => 'password'
], function () {
  Route::post('create', 'PasswordResetController@create');
  // Route::get('find/{token}', 'PasswordResetController@find');
  // Route::post('reset', 'PasswordResetController@reset');
});
