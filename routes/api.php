<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Routing\Middleware\ThrottleRequests;

Route::prefix('v1')->middleware('api.version:v1')->group(function () {

    # ----------------------------
    # PUBLIC ROUTES (Throttle only)
    # ----------------------------

    Route::middleware(['throttle:api-public'])->group(function () {
        Route::get('/test', function (Request $request) {
            return response()->json(['message' => 'public test OK']);
        })->name('test');
    });


    # --------------------------------
    # PRIVATE ROUTES (Auth + Throttle)
    # --------------------------------

    Route::middleware(['auth:sanctum', 'throttle:api-private'])->group(function() {
        //TODO: secured api end point here...
    });
});




