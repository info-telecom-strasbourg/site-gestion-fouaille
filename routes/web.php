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
use App\Http\Middleware\CASLogin;
use App\Http\Middleware\EnsureUserIsConnected;
use App\Http\Controllers\UserController;

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

Route::get('/', [UserController::class, 'checkIfUserIsConnected'])->name('home');

Route::prefix('admin')->middleware(EnsureUserIsConnected::class)->group( function() {
    Route::get('commandes', [CommandeController::class, 'index'])->name('commandes');

    Route::get('members', [MemberController::class, 'index'])->name('members');
    Route::post('member', [MemberController::class, 'store']);
    Route::get('getData', [MemberController::class, 'getData'])->name('member_getData');

    Route::get('products', function () {
        $products = app(ProductController::class)->index()->getData()['products'];
        $product_types = app(ProductTypeController::class)->index()->getData()['product_types'];
        return view('products.index')->with(compact('products', 'product_types'));
    })->name('products');
    
    Route::post('productType', [ProductTypeController::class, 'store']);
    Route::delete('productType/{id}', [ProductTypeController::class, 'destroy']);
    
    Route::post('product', [ProductController::class, 'store']);
    Route::delete('product/{id}', [ProductController::class, 'destroy']);
    Route::get('organizations', function () {
        $organizations = app(OrganizationController::class)->index()->getData()['organizations'];
        $organization_members= app(OrganizationMemberController::class)->index()->getData()['organizations'];
        $members = app(MemberController::class)->index()->getData()['members']->sortBy('last_name');
        return view('organizations.index')->with(compact('organizations', 'organization_members', 'members'));
    })->name('organizations');
    
    Route::post('organization', [OrganizationController::class, 'store']);
    Route::post('organizationMember', [OrganizationMemberController::class, 'store']);
});

Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');


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


