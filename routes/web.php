<?php

use App\Http\Controllers\CommandeController;
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

Route::get('/', [CommandeController::class, 'index']);

Route::get('getData', [MemberController::class, 'getData'])->name('member_getData');

