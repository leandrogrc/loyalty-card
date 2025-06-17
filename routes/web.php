<?php

use App\Models\Client;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EstablishmentController;


// VIEWS ROUTES
Route::get('/', function () {
    return view('homepage');
});

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $clients = Client::all();
        return view('dashboard')->with('clients', $clients);
    })->name('dashboard');

    // Establishments Views
    Route::get('/establishments', [EstablishmentController::class, 'index'])->name('establishments.index');
    Route::get('/establishments/create', [EstablishmentController::class, 'create'])->name('establishments.create');
    Route::get('/establishments/{establishment}', [EstablishmentController::class, 'show'])->name('establishments.show');
    Route::get('/establishments/{establishment}/edit', [EstablishmentController::class, 'edit'])->name('establishments.edit');
    // Establishments Actions
    Route::post('/establishments/create', [EstablishmentController::class, 'store'])->name('establishments.store');
    Route::put('/establishments/{establishment}', [EstablishmentController::class, 'update'])->name('establishments.update');
    Route::get('/establishments/{establishment}/destroy', [EstablishmentController::class, 'destroy'])->name('establishments.destroy');

    // Clients Views
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    // Clients Actions
    Route::post('/clients/create', [ClientController::class, 'store'])->name('clients.store');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}/destroy', [ClientController::class, 'destroy'])->name('clients.destroy');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
    Route::get('/register', [UserController::class, 'registerPage'])->name('register');
});


// WEB ROUTES
Route::put('/users/me/', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('/establishments/{establishment}', [EstablishmentController::class, 'destroy'])->name('establishments.destroy');



Route::post('/auth/login', [AuthController::class, 'login']);
Route::get('/auth/logout', [AuthController::class, 'logout']);
Route::post('/auth/register', [UserController::class, 'register']);

Route::get('/users/me/', [UserController::class, 'show'])->name('users.show')->middleware('auth');
