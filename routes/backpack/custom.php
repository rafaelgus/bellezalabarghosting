<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('address', 'AddressCrudController');

    Route::crud('brand', 'BrandCrudController');
    Route::crud('category', 'CategoryCrudController');
    Route::crud('empaque', 'EmpaqueCrudController');
    Route::crud('tag', 'TagCrudController');
    Route::crud('product', 'ProductCrudController');
    Route::crud('productrequest', 'ProductRequestCrudController');
    Route::crud('productrestriction', 'ProductRestrictionCrudController');

    Route::group(['prefix' => 'productrequest/{product_id}'], function () {
        Route::crud('productrequestdetails', 'ProductRequestDetailsCrudController');
        Route::crud('productrequestforsend', 'ProductRequestForSendCrudController');
    });

    Route::get('dashboard', 'AdminController@dashboard')->name('backpack.dashboard');
    Route::get('/', 'AdminController@redirect')->name('backpack');
    Route::crud('slider', 'SliderCrudController');
}); // this should be the absolute last line of this file