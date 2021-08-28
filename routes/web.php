<?php

Route::get('/clear', function () {

  Artisan::call('view:clear');
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('config:cache');
  // Artisan::call('route:clear');
});

Route::get('/test', function () {
});

#register customer and social login
Route::get('customer/auth/redirect/{provider}', 'FrontEndAuthentication\CustomerSocialController@redirect');
Route::get('customer/callback/{provider}', 'FrontEndAuthentication\CustomerSocialController@callback');

Route::group(
  [
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
  ],
  function () {

    ############### customer routes ######################
    require 'customerRoutes.php';
    ############### customer routes ######################

    ############### customer routes ######################
    // require 'sellerRoutes.php';
    ############### customer routes ######################

  }
);

Auth::routes(['register' => false]);
