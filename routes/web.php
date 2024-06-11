<?php

use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\CreateOrganizationController;
use App\Http\Controllers\FouailleChartsController;
use App\Http\Controllers\FouailleController;
use App\Http\Controllers\MarcoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\OrganizationLogoController;
use App\Http\Controllers\OrganizationMemberController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductTypeController;
use App\Models\Member;
use App\Models\Order;
use App\Models\Organization;
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
    Route::patch('/asso/{id}', [OrganizationController::class, 'update'])->name('asso.update');
    Route::post('/asso', [OrganizationController::class, 'store'])->name('asso.store');

    Route::get('/asso/member/{id}', [OrganizationMemberController::class, 'index'])->name('asso.member.index');
    Route::get('/asso/{organization_id}/member/{member_id}/edit', [OrganizationMemberController::class, 'edit'])->name('asso.member.edit');
        Route::patch('/asso/member', [OrganizationMemberController::class, 'update'])->name('asso.member.update');
    Route::post('/asso/member', [OrganizationMemberController::class, 'store'])->name('asso.member.store');
    Route::delete('/asso/member', [OrganizationMemberController::class, 'destroy'])->name('asso.member.destroy');

    Route::post('/asso/logo', [OrganizationLogoController::class, 'update'])->name('asso.logo.update');

});

