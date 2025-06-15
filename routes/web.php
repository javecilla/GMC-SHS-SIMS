<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Helpers\UserHelper;
use App\Helpers\GeneratorHelper;
use App\Enums\UserRoleEnum;
use App\Enums\GenderEnum;
use App\Enums\CompleterAsEnum;
use App\Enums\EnrollmentStatusEnum;
use App\Enums\LearningModeEnum;
use App\Enums\TuitionStatusEnum;
use App\Enums\EnrollmentVerificationStatusEnum;
use App\Helpers\FormatHelper;
use Carbon\Carbon;

Route::get('/', function () {
    //dd(UserRoleEnum::Student->value);
    //dd(GeneratorHelper::generateEnrollmentNo());
    //dd(GeneratorHelper::generateFileName('IMG', 'goodmoral', 'jpg'));
    //dd(Carbon::now()->format('Y-m-d'));
    //dd(EnrollmentVerificationStatusEnum::values());
    dd(FormatHelper::formatPersonName('Avecilla', 'Jerome', 'Sotel'));

    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
