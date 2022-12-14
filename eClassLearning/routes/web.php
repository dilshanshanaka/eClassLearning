<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseVerifierController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\IndexController;



// Public Routes
Route::get('/', [IndexController::class, 'index']);
Route::get('/course/{id}', [CourseController::class, 'publicCourse']);
Route::get('/course/title/{title}', [CourseController::class, 'apiCourse']);
Route::get('/public/instructor/{id}', [InstructorController::class, 'publicInstructor']);
Route::get('instructor-appointment/{id}', [InstructorController::class, 'appointmentAvailability'])->name('appointment.availability');
Route::get('/sub-categories/{id}', [CategoryController::class, 'subCategories']);
Route::get('/courses/main-category/{id}', [CategoryController::class, 'courseByMainCategory'])->name('courses.maincategory');
Route::get(
    '/courses/main-category/{mainCategoryId}/sub-category/{subCategoryId}',
    [CategoryController::class, 'courseBySubCategory']
)->name('courses.subcategory');
Route::post('/courses/search', [IndexController::class, 'search'])->name('courses.search');


// Guest Users Auth Routes
Route::controller(AuthController::class)->middleware(['guest'])->group(function () {
    Route::get('/login', 'loginIndex')->name('login');
    Route::get('/register', 'registerIndex')->name('register');

    // Functions
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
    Route::get('student/courses', 'courses')->name('student.courses');
    Route::get('student/course/{courseId}/module/{id}', 'content')->name('student.course.module');
    Route::get('student/course/{courseId}/quiz/{id}', 'quizzes')->name('student.course.quiz');
    Route::get('student-quiz-questions/{id}', 'moduleQuestions')->name('student.course.quiz.questions');
    Route::get('student/appointments', 'appointments')->name('student.appointments');
    Route::get('student/purchases', 'purchases')->name('student.purchases');
    Route::get('student/course/{id}', 'course')->name('student.course');
    Route::get('student/course/review/{id}', 'courseReview')->name('student.course.review');
    Route::get('student/ask-question/{id}', 'askQuestion')->name('student.question');
    Route::get('student/questions', 'questions')->name('student.questions');
    Route::put('update-student', 'updateStudent')->name('student.update');

    Route::post('student/profile-image', 'profileImage')->name('student.profileImage');
    Route::post('student/course-enroll', 'enroll')->name('student.enroll');
    Route::post('student/appointment', 'addNewAppointment')->name('student.addnewappointment');
    Route::post('create-question', 'createQuestion')->name('student.createquestion');
    Route::get('last-completed-module/{courseId}', 'lastCompletedModule')->name('student.lastcompletemodule');
    Route::patch('complete-module/{id}', 'completeModule')->name('student.module.complete');
    Route::post('create-review', 'review')->name('student.createreview');
});

// Instructor User Routes
Route::controller(InstructorController::class)->middleware(['auth', 'instructor'])->group(function () {
    // Views
    Route::get('instructor/dashboard', 'dashboard')->name('instructor.dashboard');
    Route::get('instructor/profile', 'profile')->name('instructor.profile');
    Route::get('instructor/courses', 'courses')->name('instructor.courses');
    Route::get('instructor/withdraw', 'withdraw')->name('instructor.withdraw');
    Route::get('instructor/questions', 'questions')->name('instructor.questions');
    Route::get('instructor/question/{id}', 'answerQuestions')->name('instructor.answerQuestion');
    Route::get('instructor/appointments', 'appointments')->name('instructor.appointments');
    Route::get('instructor/courses/add-new-course', 'addNewCourseView')->name('instructor.newcourse');
    Route::get('instructor/course/{courseId}', 'course')->name('instructor.course');
    Route::get('instructor/course/edit/{courseId}', 'editCourseView')->name('instructor.editcourse');
    Route::get('instructor/course/{courseId}/new-module', 'createModuleView')->name('instructor.newmodule');
    Route::get('instructor/course/{courseId}/edit-module/{moduleId}', 'updateModuleView')->name('instructor.editmodule');
    Route::get('instructor/course/{courseId}/new-quiz/{moduleNo?}', 'createQuizView')->name('instructor.newquiz');


    // Functions
    Route::put('update-instructor', 'updateInstructor')->name('instructor.update');
    Route::post('profile-image', 'uploadProfileImage')->name('instructor.profileImage');
    Route::post('add-availability', 'addAvailability')->name('instructor.addavailability');
    Route::patch('change-availability', 'changeAvailability')->name('instructor.changeavailability');
    Route::patch('update-availability', 'updateAvailability')->name('instructor.updateavailability');
    Route::post('withdraw-request', 'requestWithdraw')->name('instructor.requestwithdraw');
    Route::patch('answer-question', 'updateQuestion')->name('instructor.updatequestion');
});

// Instructor Course Function Routes
Route::controller(CourseController::class)->middleware(['auth', 'instructor'])->group(function () {
    Route::post('add-new-course', 'createCourse')->name('instructor.course.create');
    Route::patch('update-course', 'updateCourse')->name('instructor.course.update');
    Route::post('add-new-module', 'createModule')->name('instructor.course.module.create');
    Route::put('update-module', 'updateModule')->name('instructor.course.module.update');
    Route::post('add-new-quiz', 'createQuiz')->name('instructor.course.quiz.create');
});


// Admin User Routes
Route::controller(AdminController::class)->middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', 'dashboard')->name('admin.dashboard');
    Route::get('/admin/users', 'allUsers')->name('admin.users');
    Route::get('/admin/purchases', 'purchases')->name('admin.purchases');
    Route::get('/admin/withdrawals', 'withdrawals')->name('admin.withdrawals');
    Route::get('/admin/appointments', 'allAppointments')->name('admin.appointments');
    Route::get('/admin/users/students', 'students')->name('admin.users.students');
    Route::get('/admin/users/instructors', 'instructors')->name('admin.users.instructors');
    Route::get('/admin/users/course-verifiers', 'courseVerifiers')->name('admin.users.course-verifiers');
    Route::get('/admin/courses', 'courses')->name('admin.courses');
    Route::view('/admin/users/add-new-course-verifer', 'admin.add-course-verifier')->name('admin.users.add-course-verifiers');
    Route::get('/admin/users/edit/course-verifer/{courseVerifierId}', 'updateCourseVerifierView')->name('admin.users.edit-course-verifiers');


    // Functions
    Route::post('add-new-course-verifer', 'createCourseVerifier')->name('admin.user.course-verifier.create');
    Route::patch('update-course-verifer', 'updateCourseVerifier')->name('admin.user.course-verifier.update');
    Route::patch('change-user-status', 'manageUserStatus')->name('admin.user.changestatus');
    Route::patch('change-user-verification', 'changeInstructorVerification')->name('admin.user.changeverification');
    Route::patch('change-course-status', 'changeCourseStatus')->name('admin.course.changestatus');
    Route::patch('accept-withdrawal', 'acceptWithdrawRequest')->name('admin.accept-withdarw');
});


Route::get('/course-verifer/dashboard', [CourseVerifierController::class, 'dashboard'])->name('course-verifier.dashboard');
Route::get('/course-verifer/change-password', [CourseVerifierController::class, 'changePasswordView'])->name('course-verifier.change-password');
