<?php

use App\Http\Controllers\CreateOrganizationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationMemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Models\Order;
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

Route::get('/', function (){
    return view('home');
})->name('home');

Route::get('login', [UserController::class, 'login'])
    ->name('login');

Route::get('logout', [UserController::class, 'logout'])
    ->name('logout');

Route::group(['middleware' => [EnsureUserIsConnected::class]], function () {
    Route::get('/fouaille', function (){
        return view('fouaille.index');
    })->name('fouaille.index');

    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::patch('/member/{id}', [MemberController::class, 'update'])->name('member.update');

    Route::get('/marco', function (){
        return view('marco.index');
    })->name('marco.index');

    Route::get('/asso', [OrganizationController::class, 'index'])->name('asso.index');
    Route::get('/asso/{id}', [OrganizationController::class, 'show'])->name('asso.show');

    Route::get('/challenge', function (){
        return view('challenge.index');
    })->name('challenge.index');
});

/*Route::get('/', [UserController::class, 'checkIfUserIsConnected'])->name('home');

Route::prefix('admin')->middleware(EnsureUserIsConnected::class)->group( function() {
    Route::get('orders', [OrderController::class, 'index'])->name('orders');

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

    Route::get('organization', [OrganizationController::class, 'index'])->name('organization');

    Route::get('organization/create', [CreateOrganizationController::class, 'index']);
    Route::get('organization/store', [CreateOrganizationController::class, 'store']);
    Route::post('organizationMember', [OrganizationMemberController::class, 'store']);
});

Route::get('login', [UserController::class, 'login'])->name('login');
Route::get('logout', [UserController::class, 'logout'])->name('logout');*/


