<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('frontend.master.template');
});

Route::get('/admin', function () {
    return view('auth.login');
});

// RESTAURANT
Route::group(['prefix' => 'restaurant'], function (){
    Route::get          ('/',                            'RestaurantController@index'                          )->name('reason');
    Route::post         ('/save',                        'RestaurantController@store'                          )->name('reason');
    Route::get          ('/edit/{id}',                   'RestaurantController@edit'                           )->name('reason');
    Route::post         ('/update/{id}',                 'RestaurantController@update'                         )->name('reason_update');
    Route::get          ('/destroy/{id}',                'RestaurantController@destroy'                        )->name('reason_update');
});

// SALES ORDER
Route::group(['prefix' => 'sales_order'], function (){
    Route::get          ('/',                            'SalesOrderController@index'                          )->name('reason');
    Route::get          ('/complete',                    'SalesOrderController@complete'                       )->name('reason');
    Route::post         ('/save',                        'SalesOrderController@store'                          )->name('reason');
    Route::get          ('/edit/{id}',                   'SalesOrderController@edit'                           )->name('reason');
    Route::post         ('/update/{id}',                 'SalesOrderController@update'                         )->name('reason_update');
    Route::get          ('/destroy/{id}',                'SalesOrderController@destroy'                        )->name('reason_update');
});

// PAYMENT
Route::group(['prefix' => 'payment'], function (){
    Route::get          ('/',                            'PaymentController@index'                          )->name('client');
    Route::post         ('/save',                        'PaymentController@store'                          )->name('client_store');
    Route::get          ('/edit/{id}',                   'PaymentController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'PaymentController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'PaymentController@destroy'                        )->name('client_destroy');
});

// PAYMENT
Route::group(['prefix' => 'product'], function (){
    Route::get          ('/',                            'ProductController@index'                          )->name('client');
    Route::post         ('/save',                        'ProductController@store'                          )->name('client_store');
    Route::get          ('/edit/{id}',                   'ProductController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'ProductController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'ProductController@destroy'                        )->name('client_destroy');
});

Route::get('store', function () {
    return view('frontend.pages.store.place_order');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
