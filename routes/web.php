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

use Carbon\Carbon;

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
    $startDate = '2023-04-17 17:00:00';
    $endDate = '2023-04-17 23:00:00';

    $start = Carbon::parse($startDate);
    $end = Carbon::parse($endDate);

    $commandes = Commande::all()->whereBetween('date', [$startDate, $endDate]);
    $products = [];
    foreach ($commandes as $commande){
        if (!array_key_exists($commande->product->name, $products)){
            $products[$commande->product->name] = [
                'id' => $commande->product->id
            ];
        }
    }

    $date = $start->copy();
    $date->addMinutes(10);
    $datas = [];

    while ($date <= $end){
        $current_product = [];
        foreach ($products as $product => $value){
            $current_product[$product] = $commandes
                ->whereBetween('date', [$start, $date])
                ->where('id_product', $value['id'])
                ->count();
        }
        $datas[$date->format('H:i')] = $current_product;
        $date->addMinutes(10);
    }

    dd($datas);
});

Route::get('getData', [MemberController::class, 'getData'])->name('member_getData');

