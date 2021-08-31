<?php

use App\Models\ProductSeller;

Route::get('test', function () {

  $productSeller = ProductSeller::first();
  dd($productSeller->total, $productSeller->discount, $productSeller->selling_price);
  dd($productSeller->total);
});

# must guest
Route::group(['prefix'  =>  'customer',  'as' => 'customer.', 'namespace' => "Frontend\AuthCustomer", 'middleware' => 'guest:customer'], function () {
  #login
  Route::get('login', 'LoginController@showLoginForm')->name('login');

  Route::post('login', 'LoginController@login')->name('login.post');

  #register teacher and customer
  Route::get('register', 'RegisterController@showRegisterForm')->name('register');

  Route::post('register', 'RegisterController@createCustomer')->name('register.post');
});

# must customer
Route::group(['prefix' => 'customer', 'as' => 'customer.', 'namespace' => "Frontend\Customer", 'middleware' => ['auth:customer']], function () {


  Route::resource('addresses', 'AddressController')->except(['show']);

  #start profile
  Route::get('profile', 'ProfileController@profile')->name('profile');

  Route::get('edit_profile', 'ProfileController@edit_profile')->name('edit_profile');

  #orders
  Route::get('orders', 'ProfileController@orders')->name('orders');

  Route::get('orderDetails/{order}', 'ProfileController@orderDetails')->name('orderDetails');

  Route::get('change_password_view', 'ProfileController@change_password_view')->name('change_password_view');

  Route::post('change_password', 'ProfileController@change_password')->name('change_password');

  Route::put('update_profile/{customer}', 'ProfileController@update_profile')->name('update_profile');

  # favoirtes
  // Route::get('favoirtes', 'FavoirteController@favoirtes')->name('favoirtes');
  Route::get('favorites', 'ProfileController@favorites')->name('favorites');

  Route::get('add_complaint', 'ComplaintController@add_complaint')->name('add_complaint');
  Route::post('add_complaint_post', 'ComplaintController@add_complaint_post')->name('add_complaint_post');
  #end profile

  Route::get('toggle_favorite', 'FavoirteController@toggle_favorite')->name('toggle_favorite');

  #Carts
  Route::get('cart', 'CartController@cart')->name('cart');

  Route::any('addToCart', 'CartController@addToCart')->name('addToCart');

  Route::any('removeFromCart', 'CartController@removeFromCart')->name('removeFromCart');

  #checkout
  Route::get('checkout', 'OrderController@checkout')->name('checkout');

  Route::post('checkoutPost', 'OrderController@checkoutPost')->name('checkoutPost');

  Route::get('congratulation', 'CartController@congratulation')->name('congratulation');

  Route::get('callback_response', 'PaymentController@callback_response')->name('callback_response');

  // Route::get('paymentSuccess', 'CartController@paymentSuccess')->name('paymentSuccess');

  // Route::get('paymentFailed', 'CartController@paymentFailed')->name('paymentFailed');

  Route::post('getPromocodeDiscount', 'PromocodeController@getPromocodeDiscount')->name('getPromocodeDiscount');

  Route::get('removePromocode', 'PromocodeController@removePromocode')->name('removePromocode');

  #products
  Route::post('add_review', 'ReviewController@add_review')->name('add_review');

  Route::post('logout', 'ProfileController@logout')->name('logout');
});

# auth or guest
Route::group(['namespace' => "Frontend"], function () {

  Route::get('/home', 'HomeController@index');

  Route::get('/', 'HomeController@index')->name('home');

  Route::get('/search', 'HomeController@search')->name('search');

  Route::get('staticPages/{page}', 'HomeController@staticPages')->name('staticPages');

  // Route::get('/sendMail', 'HomeController@sendMail')->name('sendMail');

  Route::get('categories', 'HomeController@categories')->name('categories');

  Route::get('product/{product}/{slug?}', 'ProductController@productDetails')->name('product')->middleware('ConfirmProductHasAtLeastOneSeller');

  Route::get('products', 'ProductController@products')->name('products');

  Route::get('/blogs', 'HomeController@blogs')->name('blogs');

  Route::get('/blogDetails/{blogs}', 'HomeController@blogDetails')->name('blogDetails');

  Route::get('/contact', 'HomeController@contact')->name('contact');

  Route::post('/contactPost', 'HomeController@contactPost')->name('contactPost');

  Route::get('getRegoins', 'PublicController@getRegoins')->name('getRegoins');

  Route::get('getStates', 'PublicController@getStates')->name('getStates');

  // Route::get('mob_ifram/{session_id}', 'HomeController@mob_ifram')->name('mob_ifram');


  Route::get('customer/forget_password', 'Customer\PasswordResetController@forget_password')->name('customer.forget_password');
  Route::post('customer/send_reset_password', 'Customer\PasswordResetController@send_reset_password')->name('customer.send_reset_password');
  Route::get('customer/password/find/{token}', 'Customer\PasswordResetController@find')->name('customer.password.find');
  Route::post('customer/password/reset', 'Customer\PasswordResetController@reset')->name('customer.password.reset');
});
