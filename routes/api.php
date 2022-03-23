<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::get('/product/{id?}', [ProductController::class, 'show']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/storage/products/{file}', function(Request $request, string $file) {
   return Response::download(Storage::url('/products/' . $file));
});
Route::get('/products/unavailable', [ProductController::class, 'unavailable']);

Route::get('/categories', [CategoryController::class, 'index']);

Route::get('/services', [ServiceController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->patch('/services', [ServiceController::class, 'update']);

Route::get('/paymentTypes', [PaymentTypeController::class, 'index']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::middleware('admin')->get('/orders/last', [OrderController::class, 'last']);
    Route::post('/orders', [OrderController::class, 'create']);
});

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});
