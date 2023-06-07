<?php

use App\Http\Controllers\Api\ApiOrganizationController;
use App\Http\Controllers\Api\ApiProductController;
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

Route::get('/', function (Request $request) {
    dd($request->all());
});

Route::prefix('organization')->group( function() {
    Route::get('index', [ApiOrganizationController::class, 'index']);
    Route::get('index/small', [ApiOrganizationController::class, 'indexSmall']);

    Route::get('show/{id}', [ApiOrganizationController::class, 'show']);
    Route::get('show/{id}/image', [ApiOrganizationController::class, 'image']);
});
