<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/landing_page', function () {
    return view('landing_page');
});

Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'auth'])->name('login.auth');
Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [LoginController::class, 'logout'])->name('login.logout');


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');


    Route::get('/data-pengguna',[DashboardController::class,'showDataPengguna'])->name('dashboard.showDataPengguna');
});

Route::get('/data-pengguna', [DashboardController::class, 'showDataPengguna'])->name('dashboard.showDataPengguna')
 ->middleware('admin');

 Route::group(['middleware' => ['admin']], function(){
    Route::get('/data-pengguna', [DashboardController::class, 'showDataPengguna'])->name('dashboard.showDataPengguna');

});


