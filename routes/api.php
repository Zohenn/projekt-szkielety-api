<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Models\OrderStatus;
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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function(Request $request) {
        return $request->user();
    });
    Route::post('/logout', [AuthController::class, 'logout']);
});


Route::prefix('products')->group(function() {
    Route::get('/', [ProductController::class, 'index']);
    Route::get('/{id?}', [ProductController::class, 'show'])->where('id', '[0-9]+');
    Route::middleware(['auth:sanctum', 'admin'])->group(function() {
        Route::post('/', [ProductController::class, 'store']);
        Route::get('/unavailable', [ProductController::class, 'unavailable']);
        Route::patch('/{id}', [ProductController::class, 'update'])->where('id', '[0-9]+');
        Route::post('/{id}/image', [ProductController::class, 'editImage'])->where('id', '[0-9]+');
    });
});

Route::get('/storage/products/{file}', function(Request $request, string $file) {
    return Response::download(Storage::url('/products/' . $file));
});

Route::get('/categories', [CategoryController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->prefix('categories')->group(function() {
    Route::post('/', [CategoryController::class, 'store']);
    Route::patch('/{id}', [CategoryController::class, 'update']);
    Route::delete('/{id}', [CategoryController::class, 'destroy']);
});

Route::get('/services', [ServiceController::class, 'index']);
Route::middleware(['auth:sanctum', 'admin'])->patch('/services', [ServiceController::class, 'update']);

Route::get('/paymentTypes', [PaymentTypeController::class, 'index']);

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/orders', [OrderController::class, 'index']);
    Route::middleware('admin')->group(function() {
        Route::get('/orders/last', [OrderController::class, 'last']);
        Route::get('/orders/{id}', [OrderController::class, 'show']);
        Route::patch('/orders/{id}/changeStatus', [OrderController::class, 'changeStatus']);
    });
    Route::post('/orders', [OrderController::class, 'store']);
});

Route::get('/orderStatuses', function() {
    return OrderStatus::all();
});
