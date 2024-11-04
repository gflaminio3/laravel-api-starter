<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\V1\Auth\LoginController;
use App\Http\Controllers\V1\Auth\RegisterController;

Route::post('login', LoginController::class)->name('login');
Route::post('register', RegisterController::class)->name('register');
