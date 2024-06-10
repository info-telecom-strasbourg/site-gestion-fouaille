<?php

use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\CreateOrganizationController;
use App\Http\Controllers\CreatePartnerController;
use App\Http\Controllers\FouailleChartsController;
use App\Http\Controllers\FouailleController;
use App\Http\Controllers\MarcoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationLogoController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PartnerLogoController;
use App\Http\Controllers\OrganizationMemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Models\Member;
use App\Models\Order;
use App\Models\Organization;
use App\Models\Partner;
use App\Models\OrganizationMember;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
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
    Route::get('/fouaille', [FouailleController::class, 'index'])->name('fouaille.index');
    Route::get('/fouaille/chart', [FouailleChartsController::class, 'index'])->name('fouaille.chart.index');

    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::patch('/member/{id}', [MemberController::class, 'update'])->name('member.update');

    Route::get('/marco', [MarcoController::class, 'index'])->name('marco.index');
    Route::get('/marco/create', [MarcoController::class, 'create'])->name('marco.create');
    Route::get('/marco/{id}', [MarcoController::class, 'show'])->name('marco.show');
    Route::get('/marco/{id}/edit', [MarcoController::class, 'edit'])->name('marco.edit');
    Route::patch('/marco/{id}', [MarcoController::class, 'update'])->name('marco.update');
    Route::post('/marco', [MarcoController::class, 'store'])->name('marco.store');



    Route::get('/asso', [OrganizationController::class, 'index'])->name('asso.index');
    Route::get('/asso/create', [OrganizationController::class, 'create'])->name('asso.create');
    Route::get('/asso/{id}', [OrganizationController::class, 'show'])->name('asso.show');
    Route::get('/asso/{id}/edit', [OrganizationController::class, 'edit'])->name('asso.edit');
    Route::get('/asso/{id}/delete', [OrganizationController::class, 'delete'])->name('asso.delete');
    Route::patch('/asso/{id}', [OrganizationController::class, 'update'])->name('asso.update');
    Route::post('/asso', [OrganizationController::class, 'store'])->name('asso.store');

    Route::get('/asso/member/create/{id}', [OrganizationMemberController::class, 'create'])->name('asso.member.create');
    Route::get('/asso/member/delete/{memberid}/{assoid}', [OrganizationMemberController::class, 'delete'])->name('asso.membre.delete');
    Route::post('/asso/member', [OrganizationMemberController::class, 'store'])->name('asso.member.store');

    Route::post('/asso/logo', [OrganizationLogoController::class, 'update'])->name('asso.logo.update');


    Route::get('/spons', [PartnerController::class, 'index'])->name('spons.index');
    Route::get('/spons/create', [PartnerController::class, 'create'])->name('spons.create');
    Route::get('/spons/{id}', [PartnerController::class, 'show'])->name('spons.show');
    Route::get('/spons/{id}/edit', [PartnerController::class, 'edit'])->name('spons.edit');
    Route::get('/spons/{id}/delete', [PartnerController::class, 'delete'])->name('spons.delete');
    Route::patch('/spons/{id}', [PartnerController::class, 'update'])->name('spons.update');
    Route::post('/spons', [PartnerController::class, 'store'])->name('spons.store');

    Route::post('/spons/logo', [PartnerLogoController::class, 'update'])->name('spons.logo.update');
});

