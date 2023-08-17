<?php

use App\Http\Controllers\ChallengeController;
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
    Route::get('/fouaille', function () {
        return view('fouaille.index');
    })->name('fouaille.index');

    Route::get('/member', [MemberController::class, 'index'])->name('member.index');
    Route::get('/member/{id}', [MemberController::class, 'show'])->name('member.show');
    Route::get('/member/{id}/edit', [MemberController::class, 'edit'])->name('member.edit');
    Route::patch('/member/{id}', [MemberController::class, 'update'])->name('member.update');

    Route::get('/marco', function () {
        return view('marco.index');
    })->name('marco.index');

    Route::get('/asso', [OrganizationController::class, 'index'])->name('asso.index');
    Route::get('/asso/{id}', [OrganizationController::class, 'show'])->name('asso.show');

    Route::get('/challenge', [ChallengeController::class, 'index'])->name('challenge.index');
    Route::get('/challenge/{id}', [ChallengeController::class, 'show'])->name('challenge.show');
    Route::put('/challenge/{id}', [ChallengeController::class, 'create'])->name('challenge.create');
    Route::delete('/challenge/{id}', [ChallengeController::class, 'destroy'])->name('challenge.destroy');
});

