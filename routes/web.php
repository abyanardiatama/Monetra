<?php

use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PemasukanController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\SaldoController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\UserController;

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
    return view('login.index');
});
Route::get('/register', function () {
    return view('register.index');
});
Route::post('/register', [LoginController::class, 'register']);

Route::get('/login',[LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate']);
Route::post('/logout',[LoginController::class, 'logout']);
Route::get('/dashboard',[DashboardController::class, 'index'])->middleware('auth');

Route::resource('/pemasukan', PemasukanController::class)->middleware('auth');
Route::resource('/pengeluaran', PengeluaranController::class)->middleware('auth');
Route::resource('/saldo', SaldoController::class)->middleware('auth');
Route::resource('/dashboard/transaksi', TransaksiController::class)->middleware('auth');
Route::resource('/dashboard/kategori', KategoriController::class)->middleware('auth');
Route::get('/dashboard/settings', [UserController::class, 'settings'])->middleware('auth');
Route::put('/dashboard/user/profile/{id}', [UserController::class, 'update'])->middleware('auth');
Route::put('/dashboard/user/password/{id}', [UserController::class, 'updatePassword'])->middleware('auth');
Route::resource('/dashboard/saldo', SaldoController::class)->middleware('auth');

