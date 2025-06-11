<?php

use Illuminate\Support\Facades\Route;

#Route::versioned('v1', base_path('routes/api/v1.php'));
Route::middleware('api.version:v1')
    ->prefix('v1')
    ->name('api.v1.')
    ->group(base_path('routes/api/v1.php'));

#Route::versioned('v2', base_path('routes/api/v2.php'));
// Route::middleware('api.version:v2')
//     ->prefix('v2')
//     ->name('api.v2.')
//     ->group(base_path('routes/api/v2.php'));

