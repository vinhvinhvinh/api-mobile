<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
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

// Route::prefix('admin')->group(function () {
//   Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware('checklogin');
//   Route::get('/login', [AccountController::class, 'formlogin'])->name('form.login');
//   Route::post('/login', [AccountController::class, 'login_admin'])->name('login');
//   Route::get('/logout', [AccountController::class, 'logout_admin'])->name('logout_admin');
//   Route::group(['middleware' => ['checklogin'], 'prefix' => 'product'], function () {
//       Route::get('/', [ProductController::class, 'index'])->name('manage_product');
//       Route::post('/insert_product',[ProductController::class,'add'])->name('insert_product');
//       Route::post('/update_product/{id}',[ProductController::class,'update'])->name('update_product');
//   });
  Route::get('/', [HomeController::class, 'index'])->name('dashboard')->middleware('checklogin');
  Route::get('/login', [AccountController::class, 'formlogin'])->name('form.login');
  Route::post('/login', [AccountController::class, 'login_admin'])->name('login');
  Route::get('/logout', [AccountController::class, 'logout_admin'])->name('logout_admin');
  Route::group(['middleware' => ['checklogin'], 'prefix' => 'product'], function () {
      Route::get('/', [ProductController::class, 'index'])->name('manage_product');
      Route::post('/insert_product',[ProductController::class,'add'])->name('insert_product');
      Route::post('/update_product/{id}',[ProductController::class,'update'])->name('update_product');
  Route::group(['middleware' => ['checklogin'], 'prefix' => 'product-type'], function () {
    Route::get('/', [ProductTypeController::class, 'index'])->name('manage_productType');
    Route::post('/insert_product_type',[ProductTypeController::class,'addPT'])->name('insert_product_type');
    Route::post('/update_product_type/{id}',[ProductTypeController::class,'updatePT'])->name('update_product_type');
  });
  Route::group(['middleware' => ['checklogin'], 'prefix' => 'invoice'], function () {
    Route::get('/', [InvoiceController::class, 'index'])->name('manage_invoice');
    Route::get('/{id}', [InvoiceController::class, 'findInvoice'])->name('OrderDetail');
  });

});
