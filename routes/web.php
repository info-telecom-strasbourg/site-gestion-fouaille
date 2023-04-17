<?php

use App\Http\Controllers\CommandeController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationMemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Models\Commande;
use App\Models\Organization;
use App\Models\OrganizationMember;
use Illuminate\Support\Facades\DB;
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


Route::get('organizations', function () {
    $organizations = app(OrganizationController::class)->index()->getData()['organizations'];
    $organization_members= app(OrganizationMemberController::class)->index()->getData()['organizations'];
    return View::make('organizations.index')->with(compact('organizations', 'organization_members'));
});

Route::get('/products', function () {
    $products = app(ProductController::class)->index()->getData()['products'];
    $product_types = app(ProductTypeController::class)->index()->getData()['product_types'];
    return View::make('products.index')->with(compact('products', 'product_types'));
});

Route::post('productType', [ProductTypeController::class, 'store']);
Route::delete('productType/{id}', [ProductTypeController::class, 'destroy']);


Route::post('product', [ProductController::class, 'store']);
Route::delete('product/{id}', [ProductController::class, 'destroy']);

Route::get('charts', function () {
    dd(DB::table('commandes')
        ->select(
            'id_product',
            DB::raw('DATE_FORMAT(date, "%Y-%m-%d %H:")+FLOOR(DATE_FORMAT(date, "%i")/10)*10 as step'),
            DB::raw('SUM(amount) as totalAmount')
        )
        ->whereBetween('date', ['2022-01-01', '2023-04-15'])
        ->groupBy('id_product', 'step')
        ->get());
    return view('charts.index');
});

Route::get('getData', [MemberController::class, 'getData'])->name('member_getData');

