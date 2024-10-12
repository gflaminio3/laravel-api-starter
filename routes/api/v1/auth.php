<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\V1\LoginController;
use App\Http\Controllers\Auth\V1\RegisterController;

Route::post('login', LoginController::class)->name('login');
Route::post('register', RegisterController::class)->name('register');
