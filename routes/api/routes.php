<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Version 1 - API
Route::prefix('v1')->as('v1:')->group(base_path(
    path: 'routes/api/v1/routes.php',
));
