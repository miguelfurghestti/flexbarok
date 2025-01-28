<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ShopsController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;


Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(IsAdmin::class)->name('admin.dashboard');
Route::get('/shop/dashboard', [ShopsController::class, 'index'])->middleware(IsAdmin::class)->name('shop.dashboard');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    // return view('welcome');
    return view('login.index');
})->name('index');

Route::get('/comandas', function () {
    return view('dashboard.index');
});

Route::get('/quadras', function () {
    return view('dashboard.quadras');
});

Route::get('/clientes', function () {
    return view('dashboard.clientes');
});
