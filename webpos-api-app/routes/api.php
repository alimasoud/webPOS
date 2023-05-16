<?php

// use App\Http\Controllers\Auth\AuthController as AuthAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')->group(function () {
// });


#Product
Route::get('get-product-list', [ProductController::class, 'getAllProducts'])->name('get-product-list');
Route::post('update-product-qy', [ProductController::class, 'updateProductQuntity'])->name('update-product-qy');

#Auth
Route::post('login', [AuthController::class, 'login'])->name('login');

#Order
Route::post('create-order', [OrderController::class, 'createOrder'])->name('create-order');
Route::get('most-sold', [OrderController::class, 'getMostPopuler'])->name('most-sold');
