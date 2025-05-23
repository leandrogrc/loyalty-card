<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoyaltyCardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EstablishmentController;

## Auth Routes
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
});
Route::prefix('auth')->middleware('auth:api')->controller(AuthController::class)->group(function () {
    Route::post('/logout', 'logout');
    Route::post('/refresh', 'refresh');
    Route::get('/me', 'me');
});

## User Routes
Route::prefix('user')->controller(UserController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/create', 'store');
    Route::put('/{id}/update', 'update');
    Route::delete('/{id}/delete', 'destroy');
});

## Clients Routes ##
Route::prefix('clients')->controller(ClientController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/create', 'store');
    Route::put('/{id}/update', 'update');
    Route::delete('/{id}/delete', 'destroy');
});

## Loyalty Cards Routes ##
Route::prefix('loyalty-cards')->controller(LoyaltyCardController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/create', 'store');
    Route::put('/{id}/validate-visit', 'validate_visit');
    Route::put('/{id}/claim-reward', 'claim_reward');
});

## Visit Routes ##
Route::prefix('visits')->controller(VisitController::class)->group(function () {
    Route::get('/', 'index');
    Route::post('/create', 'store');
});

## Establishment Routes ##
Route::prefix('establishments')->controller(EstablishmentController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('/{id}', 'show');
    Route::post('/create', 'store');
    Route::delete('/{id}/delete', 'destroy');
});
