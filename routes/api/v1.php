<?php

use App\Http\Controllers\Api\V1\CampusController;
use App\Http\Controllers\Api\V1\SchoolYearController;
use App\Http\Controllers\Api\V1\SemesterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

# ----------------------------
# PUBLIC ROUTES
# ----------------------------
Route::middleware(['throttle:api-public'])->group(function () {

  Route::controller(CampusController::class)->prefix('campus')->group(function () {
    Route::get('/list', 'index')->name('campus.list');
    Route::post('/store', 'store')->name('campus.store');
    Route::get('/show/{id}', 'show')->name('campus.show');
    Route::put('/update/{id}', 'update')->name('campus.update');
    Route::delete('/delete/{id}', 'destroy')->name('campus.delete');
  });
  
  Route::controller(SchoolYearController::class)->prefix('school-year')->group(function () {
    Route::get('/list', 'index')->name('school-year.list');
    Route::post('/store', 'store')->name('school-year.store');
    Route::get('/show/{id}', 'show')->name('school-year.show');
    Route::get('/current', 'current')->name('school-year.current');
    Route::put('/update/{id}', 'update')->name('school-year.update');
    Route::delete('/delete/{id}', 'destroy')->name('school-year.delete');
  });

  Route::controller(SemesterController::class)->prefix('semester')->group(function () {
    Route::get('/list', 'index')->name('semester.list');
    Route::post('/store', 'store')->name('semester.store');
    Route::get('/show/{id}', 'show')->name('semester.show');
    Route::put('/update/{id}', 'update')->name('semester.update');
    Route::delete('/delete/{id}', 'destroy')->name('semester.delete');
  });
});

# --------------------------------
# PRIVATE ROUTES
# --------------------------------

Route::middleware(['auth:sanctum', 'throttle:api-private'])->group(function() {
  //TODO: secured api end point here...
  Route::get('/test', function (Request $request) {
    return response()->json(['message' => 'private test OK']);
  })->name('test');
});