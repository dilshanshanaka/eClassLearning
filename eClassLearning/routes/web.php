<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;




Route::get('/', function () { return view('index');});

Route::get('student/dashboard', function () { return view('student-dashboard');})->middleware(['auth', 'student'])->name('student.dashboard');
Route::get('instructor/dashboard', function () { return view('instructor-dashboard');})->middleware(['auth', 'instructor'])->name('instructor.dashboard');




Route::controller(AuthController::class)->group(function(){
    Route::get('login', 'loginIndex')->name('login');
    Route::get('register','registerIndex')->name('register');

    Route::post('create-new-user', 'store')->name('auth.register');
    Route::post('login', 'login')->name('auth.login');

    Route::get('logout', 'logout')->name('auth.logout');
});