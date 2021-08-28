<?php

Route::group(
  ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
  function () {

    Route::prefix('dashboard')->name('dashboard.')->middleware(['auth'])->group(function () {

      Route::get('/index', 'DashboardController@index')->name('index');
      Route::get('/statistics', 'DashboardController@statistics')->name('statistics');
      // notifications routes
      Route::resource('notifications', 'NotificationController')->only(['index', 'store']);

      Route::resource('sliders', 'SliderController')->except(['show']);

      Route::resource('backgrounds', 'BackgroundController')->except(['show']);

      Route::resource('complaints', 'ComplaintController');

      Route::resource('banners', 'BannerController')->except(['show']);
      Route::resource('deliveries', 'DeliveryController')->except(['show']);
      Route::resource('taxes', 'TaxController')->except(['show']);
      Route::resource('reviews', 'ReviewController')->except(['show']);


      Route::resource('sellers', 'SellerController')->except(['show']);
      #customers
      Route::resource('customers', 'CustomerController')->except(['show']);

      Route::get('customer/orders/{customer}', 'CustomerController@customer_orders')->name('customer.orders');

      #variations
      Route::resource('variations', 'VariationController')->except(['show']);
      Route::resource('options', 'OptionController')->except(['show']);
      Route::resource('rams', 'RamController')->except(['show']);
      Route::resource('capacities', 'CapacityController')->except(['show']);
      Route::resource('sims', 'SimController')->except(['show']);
      Route::resource('materials', 'MaterialController')->except(['show']);
      Route::resource('sizes', 'SizeController')->except(['show']);
      Route::resource('types', 'TypeController')->except(['show']);
      Route::resource('colors', 'ColorController')->except(['show']);

      Route::resource('specifications', 'SpecificationController')->except(['show']);

      Route::resource('products', 'Product\ProductController')->except(['show', 'destroy']);
      Route::get('products/copy_product/{product}', 'Product\ProductController@copy')->name('products.copy_product');
      Route::get('/product/delete/{product}', 'Product\ProductController@product_delete')->name('product_delete');
      Route::get('/deleteImage/products/{id}', 'Product\ProductController@deleteImage');
      Route::get('/products/approve/{id}', 'Product\ProductController@approveProduct')->name('products.approve');
      Route::post('multiple_property_action', 'Product\ProductController@multiple_property_action')->name('products.multiple_property_action');
      Route::resource('products.details', 'Product\DetailsController')->except(['show']);
      Route::resource('products.sellers', 'Product\ProductSellerController')->except(['show']);

      #product varinats
      Route::resource('product_variants', 'ProductVariantController')->except(['show']);

      //orders routes
      Route::resource('orders', 'OrderController')->except(['show',]);
      Route::get('orderDetails/{order}', 'OrderController@orderDetails')->name('orderDetails');
      Route::get('returnOrder/{order}', 'OrderController@returnOrder')->name('returnOrder');
      Route::get('returnProduct/{order}/{product}', 'OrderController@returnProduct')->name('returnProduct');

      Route::resource('offers', 'OfferController')->except(['show',]);

      // products routes
      Route::resource('brands', 'BrandController')->except(['show',]);

      Route::resource('categories', 'CategoryController')->except(['show',]);
      Route::resource('subcategories', 'SubcategoryController')->except(['show',]);
      Route::resource('subsubcategories', 'SubsubcategoryController')->except(['show',]);

      //promocodes routes
      Route::resource('promocodes', 'PoromocodeController')->except(['show',]);

      //projects routes
      Route::resource('cities', 'CityController')->except(['show',]);

      //projects routes
      Route::resource('states', 'StateController')->except(['show',]);

      //projects routes
      Route::resource('regoins', 'RegoinController')->except(['show',]);

      //blogs routes
      Route::resource('blogs', 'BlogsController')->except(['show',]);
      Route::get('/deleteImage/blog/{id}', 'BlogsController@deleteImage');


      //ads routes
      // Route::resource('ads', 'AddController')->except(['show',]);
      // Route::get('/deleteImage/ads/{id}', 'AddController@deleteImage');

      Route::resource('staticPages', 'StaticPageController')->except(['show',]);
      Route::get('/deleteImage/staticPages/{staticPage}', 'StaticPageController@deleteImage');
      // Route::resource('logins', 'LoginController')->except(['show',]);
      // Route::get('export_logins', 'LoginController@export_logins');

      //socail   Routee
      Route::resource('socail', 'SocailMediaController');

      //site_options   Route
      Route::resource('site_options', 'SiteOptionController');

      //inbox   Route
      Route::resource('inbox', 'InboxController');
      Route::get('export_inbox', 'InboxController@export_inbox');

      //user routes
      Route::resource('users', 'UserController')->except(['show']);
      Route::resource('roles', 'RoleController')->except(['show']);
      Route::get('/users/edit_profile/{user}', 'UserController@edit_profile')->name('users.edit_profile');
    }); // end of dashboard routes
  }
);

Route::group(
  ['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']],
  function () {

    Route::prefix('dashboard')->name('dashboard.')->group(function () {


      Route::get('getRegoins', 'PublicController@getRegoins')->name('getRegoins');
      Route::get('getStates', 'PublicController@getStates')->name('getStates');
      Route::get('getSubcategories', 'PublicController@getSubcategories')->name('getSubcategories');
      Route::get('getSubsubcategories', 'PublicController@getSubsubcategories')->name('getSubsubcategories');
    }); // end of dashboard routes
  }
);
