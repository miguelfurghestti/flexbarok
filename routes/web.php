<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard.index');
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
