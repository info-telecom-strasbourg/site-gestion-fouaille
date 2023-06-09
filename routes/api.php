<?php

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
    Route::get('index', [ApiProductController::class, 'index']);
});

Route::prefix('productType')->group( function() {
    Route::get('index', [ApiProductTypeController::class, 'index']);
});

Route::prefix('organization')->group( function() {
    Route::get('index', [ApiOrganizationController::class, 'index']);
    Route::get('index/small', [ApiOrganizationController::class, 'indexSmall']);

    Route::get('show/{id}', [ApiOrganizationController::class, 'show']);
    Route::get('show/{id}/image', [ApiOrganizationController::class, 'image']);
});

Route::prefix('fouaille')->group( function() {
    Route::get('command/show/{id}', [ApiFouailleController::class, 'showCommand']);

    Route::get('balance/show/{id}', [ApiFouailleController::class, 'showBalance']);

    Route::get('show/{id}', [ApiFouailleController::class, 'show']);
});
