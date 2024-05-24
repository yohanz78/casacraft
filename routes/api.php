<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FurnitureController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::resource('book', FurnitureController::class, [
    'only'=> [
        'index',
        'show'
    ]
]);

Route::resource('book', FurnitureController::class, [
    'except'=> [
        'index',
        'show'
    ]
])->middleware(['auth:api']);