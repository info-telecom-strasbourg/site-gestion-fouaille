<?php

use App\Http\Controllers\Api\ApiAuthController;
use App\Http\Controllers\Api\ApiFouailleController;
use App\Http\Controllers\Api\ApiOrganizationController;
use App\Http\Controllers\Api\ApiProductController;
use App\Http\Controllers\Api\ApiProductTypeController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

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

Route::prefix('product')->group( function() {
    Route::get('/', [ApiProductController::class, 'index']);
});

Route::prefix('productType')->group( function() {
    Route::get('/', [ApiProductTypeController::class, 'index']);
});

Route::prefix('organization')->group( function() {
    Route::get('/', [ApiOrganizationController::class, 'index']);

    Route::get('/{id}', [ApiOrganizationController::class, 'show']);
});
