<?php

use App\Http\Controllers\Api\V1\CampusController;
use App\Http\Controllers\Api\V1\SchoolYearController;
use App\Http\Controllers\Api\V1\SemesterController;
use App\Http\Controllers\Api\V1\YearLevelController;
use App\Http\Controllers\Api\V1\StrandController;
use App\Http\Controllers\Api\V1\SectionController;
use App\Http\Controllers\Api\V1\SubjectController;
use App\Http\Controllers\Api\V1\UserRoleController;
use App\Http\Controllers\Api\V1\EmployeePositionController;
use App\Http\Controllers\Api\V1\ScheduleCategoryController;
use App\Http\Controllers\Api\V1\SubjectCategoryController;
use App\Http\Controllers\Api\V1\EnrollmentController;
use App\Http\Controllers\Api\V1\RegistrationController;
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
    Route::put('/update/{id}', 'update')->name('school-year.update');
    Route::delete('/delete/{id}', 'destroy')->name('school-year.delete');
    Route::get('/current', 'current')->name('school-year.current');
  });

  Route::controller(SemesterController::class)->prefix('semester')->group(function () {
    Route::get('/list', 'index')->name('semester.list');
    Route::post('/store', 'store')->name('semester.store');
    Route::get('/show/{id}', 'show')->name('semester.show');
    Route::put('/update/{id}', 'update')->name('semester.update');
    Route::delete('/delete/{id}', 'destroy')->name('semester.delete');
  });

  Route::controller(YearLevelController::class)->prefix('year-level')->group(function () {
    Route::get('/list', 'index')->name('year-level.list');
    Route::post('/store', 'store')->name('year-level.store');
    Route::get('/show/{id}', 'show')->name('year-level.show');
    Route::put('/update/{id}', 'update')->name('year-level.update');
    Route::delete('/delete/{id}', 'destroy')->name('year-level.delete');
  });

  Route::controller(StrandController::class)->prefix('strand')->group(function () {
    Route::get('/list', 'index')->name('strand.list');
    Route::post('/store', 'store')->name('strand.store');
    Route::get('/show/{id}', 'show')->name('strand.show');
    Route::put('/update/{id}', 'update')->name('strand.update');
    Route::delete('/delete/{id}', 'destroy')->name('strand.delete');
  });

  Route::controller(SectionController::class)->prefix('section')->group(function () {
    Route::get('/list', 'index')->name('section.list');
    Route::post('/store', 'store')->name('section.store');
    Route::get('/show/{id}', 'show')->name('section.show');
    Route::put('/update/{id}', 'update')->name('section.update');
    Route::delete('/delete/{id}', 'destroy')->name('section.delete');
  });

  Route::controller(SubjectController::class)->prefix('subject')->group(function () {
    Route::get('/list', 'index')->name('subject.list');
    Route::post('/store', 'store')->name('subject.store');
    Route::get('/show/{id}', 'show')->name('subject.show');
    Route::put('/update/{id}', 'update')->name('subject.update');
    Route::delete('/delete/{id}', 'destroy')->name('subject.delete');
  });

  Route::controller(UserRoleController::class)->prefix('user-role')->group(function () {
    Route::get('/list', 'index')->name('user-role.list');
    Route::post('/store', 'store')->name('user-role.store');
    Route::get('/show/{id}', 'show')->name('user-role.show');
    Route::put('/update/{id}', 'update')->name('user-role.update');
    Route::delete('/delete/{id}', 'destroy')->name('user-role.delete');
  });

  Route::controller(EmployeePositionController::class)->prefix('employee-position')->group(function () {
    Route::get('/list', 'index')->name('employee-position.list');
    Route::post('/store', 'store')->name('employee-position.store');
    Route::get('/show/{id}', 'show')->name('employee-position.show');
    Route::put('/update/{id}', 'update')->name('employee-position.update');
    Route::delete('/delete/{id}', 'destroy')->name('employee-position.delete');
  });

  Route::controller(ScheduleCategoryController::class)->prefix('schedule-category')->group(function () {
    Route::get('/list', 'index')->name('schedule-category.list');
    Route::post('/store', 'store')->name('schedule-category.store');
    Route::get('/show/{id}', 'show')->name('schedule-category.show');
    Route::put('/update/{id}', 'update')->name('schedule-category.update');
    Route::delete('/delete/{id}', 'destroy')->name('schedule-category.delete');
  });

  Route::controller(SubjectCategoryController::class)->prefix('subject-category')->group(function () {
    Route::get('/list', 'index')->name('subject-category.list');
    Route::post('/store', 'store')->name('subject-category.store');
    Route::get('/show/{id}', 'show')->name('subject-category.show');
    Route::put('/update/{id}', 'update')->name('subject-category.update');
    Route::delete('/delete/{id}', 'destroy')->name('subject-category.delete');
  });

  Route::controller(RegistrationController::class)->prefix('registration')->group(function () {
    Route::post('/student', 'student')->name('registration.student');
    //Route::post('/employee', 'employee')->name('registration.student');
  });

  Route::controller(EnrollmentController::class)->prefix('enrollment')->group(function() {
    Route::post('/student', 'student')->name('enrollment.student');
    //Route::post('/section', 'section')->name('enrollment.section');
    //Route::post('/subject', 'subject')->name('enrollment.subject');
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