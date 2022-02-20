<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ProductTypeController;
use App\Http\Controllers\ProductController;

use App\Models\Product;

use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => 'accounts'], function () {
    Route::get('/', [AccountController::class, 'getAllAccount']);
    Route::get('/{id}',  [AccountController::class, 'getAccountDetail']);
    Route::post('/add',  [AccountController::class, 'addAccount']);
    Route::put('/updateByAdmin/{id}', [AccountController::class, 'accountUpdateAdmin']);
    Route::put('/updateByUser/{id}', [AccountController::class, 'accountUpdateUser']);
    Route::delete('/delete/{id}', [AccountController::class, 'deleteAccount']);
    Route::post('/send-mail-reset-pass', [AccountController::class, 'SendMailResetPassword']);
    Route::post('/reset-password', [AccountController::class, 'ResetPassword']);
});


Route::group(['prefix' => 'product_types'], function () {
    Route::get('/', [ProductTypeController::class, 'getAllProductType']);
    Route::get('/{id}',  [ProductTypeController::class, 'getPTDetail']);
    Route::post('/add',  [ProductTypeController::class, 'addPT']);
    Route::put('/update/{id}', [ProductTypeController::class, 'updatePT']);
    Route::post('/delete/{id}', [ProductTypeController::class, 'deletePT']);
});

Route::group(['prefix' => 'products'], function () {
    Route::get('/', [ProductController::class, 'getAllProduct']);
    Route::get('/newProduct/all', [ProductController::class, 'getNewProduct']);
    Route::get('/bstSelling/all', [ProductController::class, 'bstSelling']);
    Route::get('/prodInCart/{id}', [ProductController::class, 'getProductsInCart']);
    Route::get('/{id}',  [ProductController::class, 'getProductDetail']);
    Route::get('/productByType/{id}',  [ProductController::class, 'getProductByType']);
    Route::get('/productByFav/{id}',  [ProductController::class, 'getProductByFavorite']);
    Route::post('/add',  [ProductController::class, 'add']);
    Route::put('/update/{id}', [ProductController::class, 'update']);
    Route::post('/delete/{id}', [ProductController::class, 'delete']);
    Route::get('/search/{key}', [ProductController::class, 'search']);
});
Route::get('/products-bestselling', [ProductController::class, 'ProductBestSelling']);

##http://127.0.0.1:8000/api/
Route::group(['prefix' => 'carts'], function () {
    Route::get('/', [CartController::class, 'getAllCart']);
    Route::get('/{Id}', [CartController::class, 'findCart']);
    Route::get('/getCartofUser/{Id}', [CartController::class, 'getCartofUser']);
    Route::post('/create', [CartController::class, 'addCart']);
    Route::put('/update/{id}', [CartController::class, 'updateCartQuantity']);
    Route::delete('/delete/{id}', [CartController::class, 'deleteCart']);
    Route::delete('/deleteByAcc/{id}', [CartController::class, 'deleteCartByAccount']);
});

Route::group(['prefix' => 'invoices'], function () {
    Route::get('/', [InvoiceController::class, 'getAllInvoice']);
    Route::get('/{Id}', [InvoiceController::class, 'findInvoice']);
    Route::get('/getInvoiceofUser/{Id}', [InvoiceController::class, 'getInvoiceofUser']);
    Route::post('/create', [InvoiceController::class, 'addInvoice']);
    //Route::put('/update/{id}', [InvoiceController::class, 'updateInvoice']);
    Route::delete('/delete/{id}', [InvoiceController::class, 'deleteInvoice']);
});

Route::group(['prefix' => 'invoicedetail'], function () {
    Route::get('/', [InvoiceDetailController::class, 'getAllInvoicedetail']);
    Route::get('/{Id}', [InvoiceDetailController::class, 'findInvoiceDetail']);
    Route::post('/create', [InvoiceDetailController::class, 'addInvoiceDetail']);
    Route::delete('/delete/{id}', [InvoiceDetailController::class, 'deleteInvoiceDetail']);
});





Route::group(['prefix' => 'comments'], function () {
    Route::get('/', [CommentController::class, 'getAllComment']);
    Route::get('/{productId}', [CommentController::class, 'findCommentByProductId']);
    //Route::get('/account/{AccountId}', [CommentController::class, 'findCommentByAccountId']);
    Route::post('/create', [CommentController::class, 'addComment']);
    Route::put('/update/{id}', [CommentController::class, 'updateComment']);
    Route::delete('/delete/{id}', [CommentController::class, 'deleteComment']);
});

Route::group(['prefix' => 'favorites'], function () {
    Route::get('/', [FavoriteController::class, 'getAllFavorite']);
    Route::get('/{accountId}', [FavoriteController::class, 'findFavoriteByAccountId']);
    Route::post('/create', [FavoriteController::class, 'addFavorite']);
    Route::put('/update/{id}', [FavoriteController::class, 'updateFavorite']);
    Route::delete('/delete/{id}', [FavoriteController::class, 'deleteFavorite']);
});

//User Route
Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'getAllUser']);
    Route::get('/{id}',  [UserController::class, 'getUserDetail']);
    Route::post('/add',  [UserController::class, 'addUser']);
    Route::put('/updateByAdmin/{id}', [UserController::class, 'userUpdateAdmin']);
    Route::put('/updateByUser/{id}', [UserController::class, 'userUpdateUser']);
    Route::put('/changePassword/{id}', [UserController::class, 'changePassword']);
    Route::delete('/delete/{id}', [UserController::class, 'deleteUser']);
});

//Login route
Route::post('/login', [AccountController::class, 'login']);
Route::post('/register', [AccountController::class, 'register']);
Route::post('/logout', [AccountController::class, 'logout']);