<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductsController;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::get('{userId}/products', [ProductsController::class, 'index']);
Route::get('{userId}/products/{page}', [ProductsController::class, 'index']);

Route::get('{userId}/product/{id}', [ProductsController::class, 'show']);
Route::get('{userId}/product-category/{id}/{page}', [ProductsController::class, 'showByCategory']);