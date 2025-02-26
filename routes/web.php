<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CourtsController;
use App\Http\Controllers\ShopsController;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsShop;
use Illuminate\Support\Facades\Route;


//ADMIN
Route::get('/admin/dashboard', [AdminController::class, 'index'])->middleware(IsAdmin::class)->name('admin.dashboard');

//SHOPS
Route::get('/shop/dashboard', [ShopsController::class, 'index'])->middleware(IsShop::class)->name('shop.dashboard');
Route::get('/shop/create', [ShopsController::class, 'create'])->middleware(IsShop::class)->name('shop.create');
Route::post('/shop/store', [ShopsController::class, 'store'])->name('shop.store');

//LOGIN
Route::get('/login', [LoginController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//INDEX
Route::get('/', function () {
    // return view('welcome');
    return view('login.index');
})->name('index');

Route::get('/comandas', [ShopsController::class, 'index'])->middleware(IsShop::class)->name('shop.dashboard');

Route::get('/quadras', [CourtsController::class, 'index'])->middleware(IsShop::class)->name('shop.courts');

Route::get('/clientes', function () {
    return view('dashboard.clientes');
});