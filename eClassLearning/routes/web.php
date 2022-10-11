<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\IndexController;


Route::get('instructor/dashboard', function () {
    return view('instructor-dashboard');
})->middleware(['auth', 'instructor'])->name('instructor.dashboard');
Route::get('admin', function () {
    return view('admin.dashboard');
});

// Home Route
Route::get('/', [IndexController::class, 'index']);

// Guest Users Auth Routes
Route::controller(AuthController::class)->middleware(['guest'])->group(function () {
    Route::get('login', 'loginIndex')->name('login');
    Route::get('register', 'registerIndex')->name('register');

    Route::post('create-new-user', 'store')->name('auth.register');
    Route::post('login', 'login')->name('auth.login');
});

// Auth Users Auth Routes
Route::controller(AuthController::class)->middleware(['auth'])->group(function () {
    Route::get('logout', 'logout')->name('auth.logout');
    Route::put('change-password', 'changePassword')->name('auth.changePassword');
});

// Student User Routes
Route::controller(StudentController::class)->middleware(['auth', 'student'])->group(function () {
    Route::get('student/dashboard', 'show')->name('student.dashboard');
    Route::get('student/profile', 'profile')->name('student.profile');
    Route::put('update-student', 'updateStudent')->name('student.update');

    Route::post('profile-image', 'uploadProfileImage')->name('student.profileImage');
});

// Instructor User Routes
Route::controller(InstructorController::class)->middleware(['auth', 'instructor'])->group(function () {
    Route::get('instructor/dashboard', 'dashboard')->name('instructor.dashboard');
    Route::get('instructor/profile', 'profile')->name('instructor.profile');
    Route::put('update-instructor', 'updateInstructor')->name('instructor.update');

    Route::post('profile-image', 'uploadProfileImage')->name('instructor.profileImage');
});
