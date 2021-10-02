<?php

use App\Http\Controllers\Band\BandController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', DashboardController::class);

    Route::prefix('bands')->group(function () {
        Route::get('create', [BandController::class, 'create'])->name('bands.create');
        Route::post('create', [BandController::class, 'store']);

        Route::get('table', [BandController::class, 'table'])->name('bands.table');
    });
});
