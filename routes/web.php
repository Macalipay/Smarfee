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

Route::get('/', 'WebsiteController@index')->name('website');

Route::get('/admin', function () {
    return view('auth.login');
});

// DASHBOARD
Route::group(['prefix' => 'dashboard'], function (){
    Route::get          ('/',                            'DashboardController@index'                          )->name('reason');
    Route::post         ('/save',                        'DashboardController@store'                          )->name('reason');
    Route::get          ('/edit/{id}',                   'DashboardController@edit'                           )->name('reason');
    Route::post         ('/update/{id}',                 'DashboardController@update'                         )->name('reason_update');
    Route::get          ('/destroy/{id}',                'DashboardController@destroy'                        )->name('reason_update');
    Route::get          ('/filtering/{date}',            'DashboardController@filtering'                      )->name('reason_update');
    Route::get          ('/payment/{date}',              'DashboardController@payment'                        )->name('reason_update');
    Route::get          ('/monthly',                     'DashboardController@monthly'                        )->name('reason_update');
    Route::get          ('/income_expense',              'DashboardController@incomeExpense'                  )->name('reason_update');
    Route::get          ('/piechart',                    'DashboardController@piechart'                       )->name('reason_update');
    Route::get          ('/piechart_masterfile',         'DashboardController@piechart_masterfile'            )->name('reason_update');
    Route::get          ('/bargraph',                    'DashboardController@bargraph'                       )->name('reason_update');
    Route::get          ('/bargraph_masterfile',         'DashboardController@bargraph_masterfile'            )->name('reason_update');
    Route::get          ('/bargraph_expense',            'DashboardController@bargraph_expense'               )->name('reason_update');
    Route::get          ('/masterfile',                  'DashboardController@masterfile'                     )->name('reason_update');
});

// ORDER
Route::group(['prefix' => 'order'], function (){
    Route::post         ('/show/{id}',                        'OrderController@show'                          )->name('reason');
});

// SHOP
Route::group(['prefix' => 'shop'], function (){
    Route::get          ('/',                            'ShopController@index'                          )->name('selection');
    Route::get          ('/order/{id}',                  'ShopController@shop'                          )->name('selection');
    Route::post         ('/save',                        'ShopController@store'                          )->name('reason');
    Route::get          ('/edit/{id}',                   'ShopController@edit'                           )->name('reason');
    Route::post         ('/update/{id}',                 'ShopController@update'                         )->name('reason_update');
    Route::get          ('/destroy/{id}',                'ShopController@destroy'                        )->name('reason_update');
    Route::get          ('/add_to_cart',                 'ShopController@addCart'                        )->name('reason_update');
    Route::get          ('/shopping_bag',                'ShopController@shopping_bag'                   )->name('reason_update');
    Route::get          ('/check_out',                   'ShopController@check_out'                   )->name('reason_update');
    Route::get          ('/login',                       'ShopController@login'                          )->name('reason_update');
    Route::get          ('/register',                    'ShopController@register'                       )->name('reason_update');
    Route::get          ('/history',                     'ShopController@history'                        )->name('reason_update');
});

// INVENTORY
Route::group(['prefix' => 'inventory'], function (){
    Route::get          ('/',                            'InventoryController@index'                          )->name('selection');
    Route::post         ('/add_stock',                   'InventoryController@add_stock'                      )->name('selection');
    Route::get          ('/view_add_stock',              'InventoryController@view_add_stock'                 )->name('selection');
    Route::get          ('/stock/edit/{id}',             'InventoryController@stock_edit'                     )->name('selection');
    Route::post         ('/save',                        'InventoryController@store'                          )->name('reason');
    Route::get          ('/edit/{id}',                   'InventoryController@edit'                           )->name('reason');
    Route::post         ('/update/{id}',                 'InventoryController@update'                         )->name('reason_update');
    Route::post         ('/stock/update/{id}',           'InventoryController@stock_update'                   )->name('reason_update');
    Route::get          ('/destroy/{id}',                'InventoryController@destroy'                        )->name('reason_update');
    Route::get          ('/stock/destroy/{id}',          'InventoryController@stock_destroy'                  )->name('reason_update');
});

// DAILY SALES
Route::group(['prefix' => 'daily_sales'], function (){
    Route::get          ('/',                               'DailySaleController@index'                          )->name('selection');
    Route::get          ('/all',                            'DailySaleController@all'                            )->name('reason');
    Route::post         ('/save',                           'DailySaleController@store'                          )->name('reason');
    Route::get          ('/edit/{id}',                      'DailySaleController@edit'                           )->name('reason');
    Route::post         ('/update/{id}',                    'DailySaleController@update'                         )->name('reason_update');
    Route::post         ('/productionStatus/{id}',          'DailySaleController@productionStatus'               )->name('reason_update');
    Route::post         ('/paymentStatus/{id}',             'DailySaleController@paymentStatus'                  )->name('reason_update');
    Route::get          ('/destroy/{id}',                   'DailySaleController@destroy'                        )->name('reason_update');
});

// PAYMENT
Route::group(['prefix' => 'payment'], function (){
    Route::get          ('/',                            'PaymentController@index'                          )->name('client');
    Route::post         ('/save',                        'PaymentController@store'                          )->name('client_store');
    Route::get          ('/edit/{id}',                   'PaymentController@edit'                           )->name('client_edit');
    Route::post         ('/update/{id}',                 'PaymentController@update'                         )->name('client_update');
    Route::get          ('/destroy/{id}',                'PaymentController@destroy'                        )->name('client_destroy');
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

// DRIVER
Route::group(['prefix' => 'driver'], function (){
    Route::get          ('/',                            'DriverController@index'                           )->name('client');
    Route::post         ('/save',                        'DriverController@store'                           )->name('client_store');
    Route::get          ('/edit/{id}',                   'DriverController@edit'                            )->name('client_edit');
    Route::post         ('/update/{id}',                 'DriverController@update'                          )->name('client_update');
    Route::get          ('/destroy/{id}',                'DriverController@destroy'                         )->name('client_destroy');
});

// CITY NAME
Route::group(['prefix' => 'city'], function (){
    Route::get          ('/',                            'CityController@index'                           )->name('client');
    Route::post         ('/save',                        'CityController@store'                           )->name('client_store');
    Route::get          ('/edit/{id}',                   'CityController@edit'                            )->name('client_edit');
    Route::post         ('/update/{id}',                 'CityController@update'                          )->name('client_update');
    Route::get          ('/destroy/{id}',                'CityController@destroy'                         )->name('client_destroy');
});

// RULES AND RESTRICTION
Route::group(['prefix' => 'rule'], function (){
    Route::get          ('/',                            'RuleController@index'                           )->name('client');
    Route::post         ('/save',                        'RuleController@store'                           )->name('client_store');
    Route::get          ('/edit/{id}',                   'RuleController@edit'                            )->name('client_edit');
    Route::post         ('/update/{id}',                 'RuleController@update'                          )->name('client_update');
    Route::get          ('/destroy/{id}',                'RuleController@destroy'                         )->name('client_destroy');
});

// TERMS AND CONDITION
Route::group(['prefix' => 'term'], function (){
    Route::get          ('/',                            'TermController@index'                           )->name('client');
    Route::post         ('/save',                        'TermController@store'                           )->name('client_store');
    Route::get          ('/edit/{id}',                   'TermController@edit'                            )->name('client_edit');
    Route::post         ('/update/{id}',                 'TermController@update'                          )->name('client_update');
    Route::get          ('/destroy/{id}',                'TermController@destroy'                         )->name('client_destroy');
});

// TERMS AND CONDITION
Route::group(['prefix' => 'user'], function (){
    Route::get          ('/',                            'UserController@index'                           )->name('client');
    Route::post         ('/save',                        'UserController@store'                           )->name('client_store');
    Route::get          ('/edit/{id}',                   'UserController@edit'                            )->name('client_edit');
    Route::post         ('/update/{id}',                 'UserController@update'                          )->name('client_update');
    Route::get          ('/destroy/{id}',                'UserController@destroy'                         )->name('client_destroy');
});

Route::get('store', function () {
    return view('frontend.pages.store.place_order');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
