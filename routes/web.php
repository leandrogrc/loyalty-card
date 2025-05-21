<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\LoyaltyCardController;

Route::get('/', function () {
    return view('welcome');
});