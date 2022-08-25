<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\Employee\CategoryController;
use App\Http\Controllers\Employee\DashboardController;
use App\Http\Controllers\Employee\EmployeeDataController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Employee\ProductsController;
use App\Http\Controllers\ShopController;
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
Route::get('/', HomeController::class. '@index')->name('homepage');
Route::get('/shop/{slug?}', ShopController::class. '@index')->name('shop.index');
Route::get('/cart', CartController::class. '@index')->name('cart.index');
Route::get('/product/{slug}', ProductController::class. '@show')->name('product.show');
Route::get('/order/checkout', OrderController::class. '@process')->name('order.checkout');
Route::get('/order/success', OrderController::class. '@finished')->name('order.success');

// employee controller
Route::group(['middleware' => ['role:cashier|manager|chef']], function () {
    Route::get('/dashboard', DashboardController::class. '@index')->name('dashboard');

    // EmployeeData
    Route::get('/employeeData', EmployeeDataController::class. '@index')->name('employeeData.index');
    Route::get('/employeeData/list', EmployeeDataController::class. '@getEmployeeData')->name('employeeData.list');

    // Category
    Route::resource('category', CategoryController::class);
    Route::post('category/images', CategoryController::class.'@storeImg')->name('category.storeImg');
    
    //product
    Route::resource('products', ProductsController::class);
    Route::post('products/images', ProductsController::class.'@storeImg')->name('products.storeImg');
});

require __DIR__.'/auth.php';
