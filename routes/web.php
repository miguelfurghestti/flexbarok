<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return view('welcome');
    return view('dashboard.index');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});
