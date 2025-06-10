<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\Middleware\ValidateCsrfToken;
use Illuminate\Routing\Middleware\ThrottleRequests;
use App\Http\Controllers\Api\V1\CampusController;
use App\Http\Controllers\Api\V1\SchoolYearController;

Route::prefix('v1')->middleware('api.version:v1')->group(function () {
    # ----------------------------
    # PUBLIC ROUTES (Throttle only)
    # ----------------------------
    Route::middleware(['throttle:api-public'])->group(function () {
        # Campus
        Route::prefix('campus')->group(function () {
            Route::get('/list', [CampusController::class, 'index'])->name('campus.list');
            Route::post('/store', [CampusController::class, 'store'])->name('campus.store');
            Route::get('/show/{id}', [CampusController::class, 'show'])->name('campus.show');
            Route::put('/update/{id}', [CampusController::class, 'update'])->name('campus.update');
            Route::delete('/delete/{id}', [CampusController::class, 'destroy'])->name('campus.delete');
        });
        
        # School Year
        Route::prefix('school-year')->group(function () {
            Route::get('/list', [SchoolYearController::class, 'index'])->name('school-year.list');
            Route::post('/store', [SchoolYearController::class,'store'])->name('school-year.store');
            Route::get('/show/{id}', [SchoolYearController::class, 'show'])->name('school-year.show');
            Route::get('/current', [SchoolYearController::class, 'current'])->name('school-year.current');
            Route::put('/update/{id}', [SchoolYearController::class, 'update'])->name('school-year.update');
            Route::delete('/delete/{id}', [SchoolYearController::class, 'destroy'])->name('school-year.delete');
        });
    });


    # --------------------------------
    # PRIVATE ROUTES (Auth + Throttle)
    # --------------------------------

    Route::middleware(['auth:sanctum', 'throttle:api-private'])->group(function() {
        //TODO: secured api end point here...
        Route::get('/test', function (Request $request) {
            return response()->json(['message' => 'private test OK']);
        })->name('test');
    });
});




