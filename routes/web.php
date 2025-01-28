<?php

use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\ShopsController;
use Illuminate\Support\Facades\Route;


Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/shop/dashboard', [ShopsController::class, 'index'])->name('shop.dashboard');

Route::get('/', function () {
    // return view('welcome');
    return view('login.index');
});

Route::get('/comandas', function () {
    return view('dashboard.index');
});

Route::get('/quadras', function () {
    return view('dashboard.quadras');
});

Route::get('/clientes', function () {
    return view('dashboard.clientes');
});
