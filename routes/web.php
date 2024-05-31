<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/furniture', function () {
    return view('pages.plp');
})->name('plp');

Route::get('/furniture/{id}', function () {
    return view('pages.pdp');
})->name('pdp');