<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/login');
    // return view('welcome');
});




Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'adminHome'])->name('admin.home')->middleware('is_admin');
Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/logout', 'App\Http\Controllers\LogoutController@perform')->name('logout.perform');
        
    Route::get('/inventories/export', 'App\Http\Controllers\InventoryController@export')->name('inventory.export');
    Route::get('/deliveries/export', 'App\Http\Controllers\DeliveryController@export')->name('delivery.export');
    Route::get('/customer_sales/export', 'App\Http\Controllers\CustomerSalesController@export')->name('sales.export');

    Route::resource('/dashboard', 'App\Http\Controllers\DashboardController');
    #route for sales transaction monitoring
    Route::resource('/customers', 'App\Http\Controllers\CustomersController');
    Route::resource('/categories', 'App\Http\Controllers\CategoriesController');
    Route::resource('/customer_sales', 'App\Http\Controllers\CustomerSalesController');
    Route::resource('/inventories', 'App\Http\Controllers\InventoryController' );
    // Route::resource('/sales', 'App\Http\Controllers\SalesController' );----------
    Route::resource('/mops', 'App\Http\Controllers\ModeofPaymentController' );
    //Route::resource('/beverages_list', 'App\Http\Controllers\BeveragesListsController' ); --------------------
    Route::resource('/beverages_list', 'App\Http\Controllers\ProductController' );
    Route::resource('/purchase', 'App\Http\Controllers\SalesInvoicesController' );
    Route::resource('/suppliers', App\Http\Controllers\SuppliersController::class );
    Route::resource('/orders', 'App\Http\Controllers\OrderController');
    // Route::resource('/userlogs', 'App\Http\Controllers\UserLogsController' );---------
    // Route::resource('/account_payables', 'AccountPayablesController' );
    Route::resource('/controller', 'App\Http\Controllers\Controller' );

    Route::resource('/purchases', 'App\Http\Controllers\PurchasesController');
    Route::resource('/purchased', 'App\Http\Controllers\PurchasedController');
    Route::resource('/users', 'App\Http\Controllers\UserController');
    Route::resource('/deliveries', 'App\Http\Controllers\DeliveryController');
    // Route::get('/users', [UserController::class, 'index'])->name('users.index');
 });



 Auth::routes(); 