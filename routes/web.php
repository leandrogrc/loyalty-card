<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstablishmentController;

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('users')->group(function () {
    Route::get('/create', function () {
        return view('create_user');
    });

    Route::get('/list', [UserController::class, 'index']); //->name('users.list');
});

Route::get('/establishments/list', [EstablishmentController::class, 'index'])->name('establishments.index');
Route::get('/establishments/{id}', [EstablishmentController::class, 'show'])->name('establishments.show');
