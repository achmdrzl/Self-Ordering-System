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
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\CategoryList;
use App\Models\Customer;
use App\Models\detailOrder;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

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
Route::get('/set/{no_table}', HomeController::class. '@welcomePage');

Route::get('/', HomeController::class. '@index')->name('homepage');
Route::get('/shop/{slug}', ShopController::class. '@index')->name('shop.index');

// Cart Collection
Route::resource('cart', CartController::class);

// Product Show
Route::get('/product/{product:slug}', ProductController::class . '@show')->name('product.show');

// Order Flow
Route::resource('order', OrderController::class);

// Checkout
Route::get('/checkout', CheckoutController::class . '@index')->name('checkout.index');
Route::get('/success', CheckoutController::class . '@show')->name('checkout.show');
// Route::post('/placeOrder', OrderController::class . '@finished')->name('place.order');

// React Route
Route::get('/categories', HomeController::class . '@getCategories');
Route::get('/sorting', ShopController::class . '@sortingItems');
Route::get('/customers', TablesController::class. '@getTables');

// employee controller
Route::group(['middleware' => ['role:cashier|manager|chef']], function () {
    // Dashboard
    Route::get('/dashboard', DashboardController::class . '@index')->name('dashboard');

    // EmployeeData
    Route::get('/employeeData', EmployeeDataController::class . '@index')->name('employeeData.index');
    Route::get('/employeeData/list', EmployeeDataController::class . '@getEmployeeData')->name('employeeData.list');

    // Category
    Route::resource('category', CategoryController::class);
    Route::post('category/images', CategoryController::class . '@storeImg')->name('category.storeImg');

    // Product
    Route::resource('products', ProductsController::class);
    Route::post('products/images', ProductsController::class . '@storeImg')->name('products.storeImg');

    // Order
    Route::resource('orders', OrdersController::class);

    // Tables Management
    Route::resource('tables', TablesController::class);

    // Payment
    Route::get('/payment', PaymentController::class. '@index')->name('index.payment');
    Route::get('/cash', PaymentController::class. '@cashPay')->name('cash.pay');

});


// Route::get('/cek', function(){
//     return Customer::with('orders')->get();
// });

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
