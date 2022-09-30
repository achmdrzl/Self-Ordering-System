<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Employee\CategoryController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\EmployeeDataController;
use App\Http\Controllers\Employee\OrdersController;
use App\Http\Controllers\Employee\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Employee\ProductsController;
use App\Http\Controllers\Employee\TablesController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ShopController;
use Illuminate\Routing\RouteGroup;
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

// user controller
Route::get('/set/{no_table}', HomeController::class . '@welcomePage');
Route::post('/set/{no_table}', HomeController::class . '@welcomePage');

Route::group(['middleware' => ['table']], function(){

    Route::get('/home', HomeController::class . '@index')->name('homepage');
    Route::get('/shop/{slug}', ShopController::class . '@index')->name('shop.index');
    
    // Cart Collection
    Route::resource('cart', CartController::class);
    
    // Product Show
    Route::get('/product/{product:slug}', ProductController::class . '@show')->name('product.show');
    
    // Order Flow
    Route::resource('order', OrderController::class);
    Route::get('/status_order', CheckoutController::class . '@show')->name('status.order');
    
    // Checkout
    Route::get('/checkout', CheckoutController::class . '@index')->name('checkout.index');
    Route::get('/success', CheckoutController::class . '@show')->name('checkout.show');
    // Route::post('/placeOrder', OrderController::class . '@finished')->name('place.order');
    
    // React Route
    Route::get('/categories', HomeController::class . '@getCategories');
    Route::get('/sorting', ShopController::class . '@sortingItems');
    Route::get('/customers', TablesController::class . '@getTables');

});

// employee controller
Route::group(['middleware' => ['role:cashier|manager|chef']], function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class . '@index')->name('dashboard');
    Route::get('/status_order/{id}', DashboardController::class . '@update_status')->name('update.status.order');

    // EmployeeData
    Route::resource('employeeData', EmployeeDataController::class);
    Route::get('/employeeData/list', EmployeeDataController::class . '@getEmployeeData')->name('employeeData.list');


    // Category
    Route::resource('category', CategoryController::class);
    Route::post('category/images', CategoryController::class . '@storeImg')->name('category.storeImg');

    // Product
    Route::resource('products', ProductsController::class);
    Route::post('products/images', ProductsController::class . '@storeImg')->name('products.storeImg');
    Route::post('productsUpdated/{id}', ProductsController::class. '@updated')->name('products.updated');

    // Order
    Route::resource('orders', OrdersController::class);
    Route::get('/showOrder/{id}', DashboardController::class . '@show')->name('show.order');
    Route::get('/printPDF/{id}', OrdersController::class . '@printPDF')->name('print.pdf');

    // Tables Management
    Route::resource('tables', TablesController::class);
    Route::get('printTable/{id}', TablesController::class . '@printTable')->name('print.table');

    // Payment
    Route::get('/payment', PaymentController::class . '@index')->name('index.payment');
    Route::post('/cashless/{id}', PaymentController::class . '@cashlessPay')->name('cashless.pay');
    Route::post('/cash/{id}', PaymentController::class . '@cashPay')->name('cash.pay');

    // Report Sales
    Route::get('/report', ReportController::class . '@index')->name('report.index');
    Route::post('/setPeriod', ReportController::class . '@setPeriod')->name('set.time.period');
});


// Route::get('/cekRelasi', function(){
//     return Order::with(['orderProduct.product'])->get();
// });

Route::get('/', function(){
    return view('frontend.scanPage');
});

// Route::get('/set/{no_table}', function(Request $request, $no_table){
//     $request->session()->put('no_table', $no_table);

//     // echo request()->session()->has('no_table');
// });
// Route::get('/see', function(){
//     // return Customer::with('orders')->get();
//     if (request()->session()->has('no_table')) {
//         echo request()->session()->get('no_table');
//     } else {
//         echo 'Tidak ada data dalam session.';
//     }
// });

require __DIR__ . '/auth.php';
