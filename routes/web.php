<?php

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

Route::get('/', [MembreController::class, 'index'])->name('membre_index');
Route::get('getData', [MembreController::class, 'getData'])->name('membre_getData');

