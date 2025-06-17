<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EstablishmentController;


// VIEWS ROUTES
Route::get('/', function () {
    return view('homepage');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');


    Route::get('/establishments', [EstablishmentController::class, 'index'])->name('establishments.index');
    Route::get('/establishments/create', [EstablishmentController::class, 'create'])->name('establishments.create');
    Route::get('/establishments/{establishment}', [EstablishmentController::class, 'show'])->name('establishments.show');
    Route::get('/establishments/{establishment}/edit', [EstablishmentController::class, 'edit'])->name('establishments.edit');
    Route::get('/establishments/{establishment}/destroy', [EstablishmentController::class, 'destroy'])->name('establishments.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::get('/register', [UserController::class, 'registerPage'])->name('register');
});

// WEB ROUTES
Route::put('/users/me/', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::post('/establishments/create', [EstablishmentController::class, 'store'])->name('establishments.store');
Route::put('/establishments/{establishment}', [EstablishmentController::class, 'update'])->name('establishments.update');
Route::delete('/establishments/{establishment}', [EstablishmentController::class, 'destroy'])->name('establishments.destroy');

Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/register', [UserController::class, 'register']);

Route::get('/users/me/', [UserController::class, 'show'])->name('users.show')->middleware('auth');
