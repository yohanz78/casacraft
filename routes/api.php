<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\FurnitureController;
use App\Http\Controllers\API\AuthController;

Route::prefix('user')->group(function () {
    Route::get('/users', function (Request $req) {
        return $req->user();
    });
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');
});

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