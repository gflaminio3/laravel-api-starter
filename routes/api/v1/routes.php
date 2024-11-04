<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Auth routes
Route::middleware(['throttle:auth'])->as('auth:')->group(base_path(path: 'routes/api/v1/auth.php'));
