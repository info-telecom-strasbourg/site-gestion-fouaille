<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Models\Commande;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MembreController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('commandes', [CommandeController::class, 'index']);
Route::get('members', [MemberController::class, 'index']);

Route::get('/products', function () {
    $products = app(ProductController::class)->index()->getData()['products'];
    $product_types = app(ProductTypeController::class)->index()->getData()['product_types'];
    return View::make('products.index')->with(compact('products', 'product_types'));
});

Route::post('productType', [ProductTypeController::class, 'store']);
Route::delete('productType/{type}', function ($type) {
    dd(\App\Models\ProductType::find('type'));
    return back();
});


Route::post('product', [ProductController::class, 'store']);

Route::get('charts', function () {
    return view('charts.index');
});

Route::get('getData', [MemberController::class, 'getData'])->name('member_getData');

