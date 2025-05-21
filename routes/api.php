<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoyaltyCardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\AuthController;

## User Routes
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user/create', [UserController::class, 'store']);

## Auth Routes
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/me', [AuthController::class, 'me']);
});

## Clients Routes ##

// listar Clientes
Route::get('/client', [ClientController::class, 'index']);
// criar Cliente
Route::post('/client/create', [ClientController::class, 'store']);
// deletar Cliente
Route::delete('/client/{id}/delete', [ClientController::class, 'destroy']);
// atualizar Cliente
Route::put('/client/{id}/update', [ClientController::class, 'update']);
## Loyalty Cards Routes ##
// listar atendimentos
Route::get('/loyalty-cards', [LoyaltyCardController::class, 'index']);
// Criar atendimento
Route::post('/loyalty-cards', [LoyaltyCardController::class, 'store']);
// Validar atendimento
Route::put('/loyalty-cards/{id}/validate', [LoyaltyCardController::class, 'validateCard']);
Route::get('/clients/{id}/loyalty-card', [LoyaltyCardController::class, 'show']);
Route::post('/loyalty-cards/{id}/visits', [VisitController::class, 'store']);
