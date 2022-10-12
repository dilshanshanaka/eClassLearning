<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\IndexController;



Route::get('admin', function () {
    return view('admin.dashboard');
});

// Home Route
Route::get('/', [IndexController::class, 'index']);

Route::get('/course/{id}', [CourseController::class, 'publicCourse']);

Route::get('/sub-categories/{id}', [CategoryController::class, 'subCategories']);


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
    // Views
    Route::get('instructor/dashboard', 'dashboard')->name('instructor.dashboard');
    Route::get('instructor/profile', 'profile')->name('instructor.profile');
    Route::get('instructor/courses', 'courses')->name('instructor.courses');
    Route::get('instructor/courses/add-new-course', 'addNewCourseView')->name('instructor.newcourse');
    Route::get('instructor/course/{courseId}', 'course')->name('instructor.course');
    Route::get('instructor/course/edit/{courseId}', 'editCourseView')->name('instructor.editcourse');
    Route::get('instructor/course/{courseId}/new-module', 'createModuleView')->name('instructor.newmodule');
    Route::get('instructor/course/{courseId}/edit-module/{moduleId}', 'updateModuleView')->name('instructor.editmodule');


    // Functions
    Route::put('update-instructor', 'updateInstructor')->name('instructor.update');
    Route::post('profile-image', 'uploadProfileImage')->name('instructor.profileImage');
    
});

// Instructor Course Function Routes
Route::controller(CourseController::class)->middleware(['auth', 'instructor'])->group(function () {
    Route::post('add-new-course', 'createCourse')->name('instructor.course.create');
    Route::patch('update-course', 'updateCourse')->name('instructor.course.update');
    Route::post('add-new-module', 'createModule')->name('instructor.course.module.create');
    Route::put('update-module', 'updateModule')->name('instructor.course.module.update');
});
