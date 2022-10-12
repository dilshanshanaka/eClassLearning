<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\MainCategory;
use App\Models\Module;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    // Index
    public function dashboard()
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();

        // User Email
        $email = Auth::user()->email;

        $courses = Course::where('instructor_id', $instructor->id)->latest()->get();

        $mainCategories = MainCategory::all();
        $subCategories = SubCategory::all();

        return view('instructor.dashboard', compact('email', 'instructor', 'mainCategories', 'subCategories', 'courses'));
    }

    // Profile
    public function profile()
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();

        // User Email
        $email = Auth::user()->email;

        return view('instructor.profile', compact('email', 'instructor'));
    }

    // Update Instructor
    public function updateInstructor(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:60'],
            'lastName'  => ['required', 'string', 'max:60'],
            'mobile' => ['required', 'string', 'max:20'],
            'nic' => ['required', 'string', 'max:20'],
            'city' => ['required', 'string', 'max:40'],
            'bio' => ['required', 'string', 'max:300']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        Instructor::where('user_id', Auth::id())
            ->update([
                'first_name' => $request->firstName, 'last_name' => $request->lastName,
                'mobile' => $request->mobile, 'nic' => $request->nic,
                'city' => $request->city, 'bio' => $request->bio
            ]);


        return response()->json(['message' => "Successfully updated."], 200);
    }

    // Upload Profile Picture
    public function uploadProfileImage(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'profileImageInput' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ]);

        // Upload File Extension
        $extension = $request->file('profileImageInput')->getClientOriginalExtension();

        // Rename File
        $fileName = rand(11111, 999999) . '.' . $extension;

        // Store in public disk
        $request->file('profileImageInput')->move(public_path('images/instructor'), $fileName);

        // Saved Path
        $path = "images/instructor/" . $fileName;

        // Update Profile Path
        Instructor::where('user_id', Auth::id())
            ->update(['profile_image_path' => $path]);

        // Return Success
        return response()->json(['success' => "Profile image upload success."]);
    }

    // Index
    public function courses()
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        // Intructor Courses
        $courses = Course::where('instructor_id', $instructor->id)->latest()->get();

        return view('instructor.courses', compact('email', 'instructor', 'courses'));
    }

    // Create New Course View
    public function addNewCourseView()
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;
        $mainCategories = MainCategory::all();

        return view('instructor.new-course', compact('email', 'instructor', 'mainCategories'));
    }

    public function editCourseView($courseId)
    {
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;
        $mainCategories = MainCategory::all();
        $course = Course::where('id', $courseId)->first();

        return view('instructor.edit-course', compact('instructor', 'email', 'course', 'mainCategories'));
    }

    // Create New Module
    public function createModuleView($courseId)
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $course = Course::where('id', $courseId)->first();
        $module = Module::where('course_id', $courseId)->latest()->first();

        return view('instructor.new-module', compact('email', 'instructor', 'course', 'module'));
    }

    // Create New Quiz
    public function createQuiz()
    {
        //
    }



    // Update Module
    public function updateModuleView($courseId, $moduleId)
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $module = Module::where('id', $moduleId)->first();

        return view('instructor.edit-module', compact('email', 'instructor', 'courseId', 'module'));
    }


    // Update Quiz
    public function updateQuiz()
    {
        //
    }


    // Course Detailed View
    public function course($courseId)
    {
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $modules = Module::where('course_id', $courseId)->orderBy('module_no')->get();

        $course = Course::where('id', $courseId)->first();

        return view('instructor.course', compact('instructor', 'email', 'course', 'modules'));
    }
}
