<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\OrderController;
use App\Http\Controllers\api\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Authentication
route::post('/login', [AuthController::class, 'login']);
route::post('/register', [AuthController::class, 'register']);
route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');


// Product
route::apiResource('products', ProductController::class)->middleware('auth:sanctum');

// Order
route::get('/orders/{id}', [OrderController::class, 'viewOrders'])->middleware('auth:sanctum');
route::post('/order', [OrderController::class, 'order'])->middleware('auth:sanctum');
