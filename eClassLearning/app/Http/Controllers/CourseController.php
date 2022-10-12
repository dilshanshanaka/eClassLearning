<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Module;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    // Public Course View
    public function publicCourse($courseId)
    {
        $course = Course::where('id', $courseId)->first();

        // return response()->json(['course' => $course], 200);

        return view('course', compact('course'));
    }

    // Create New Course
    public function createCourse(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:5', 'max:50'],
            'hour' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'subCategoryId' => ['required'],
            'description' => ['required', 'string'],
            'coverImage' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        // Instructor ID From Logged In User
        $instructorId = Instructor::where('user_id', Auth::id())->first()->id;

        // Image Upload
        $extension = $request->file('coverImage')->getClientOriginalExtension();
        $fileName = rand(11111, 999999) . '.' . $extension;
        $request->file('coverImage')->move(public_path('images/course'), $fileName);
        $path = "images/course/" . $fileName;

        // Create New Course
        $course = new Course;
        $course->title = $request->title;
        $course->description = $request->description;
        $course->estimated_total_time = $request->hour;
        $course->price = $request->price;
        $course->status = "pending";
        $course->isVerified = false;
        $course->image_path = $path;
        $course->instructor_id = $instructorId;
        $course->sub_category_id = $request->subCategoryId;
        $course->save();

        // Return Success
        return response()->json(['success' => "New Course Added Successfully."]);
    }

    // Update Course
    public function updateCourse(Request $request)
    {
        $courseId = $request->courseId;

        // Form data Validation
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:5', 'max:50'],
            'hour' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'subCategoryId' => ['required'],
            'description' => ['required', 'string'],
            'coverImage' => ['image', 'mimes:jpeg,png,jpg', 'max:2048']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if ($request->file('coverImage') != NULL) {
            // Image Upload
            $extension = $request->file('coverImage')->getClientOriginalExtension();
            $fileName = rand(11111, 999999) . '.' . $extension;
            $request->file('coverImage')->move(public_path('images/course'), $fileName);
            $path = "images/course/" . $fileName;
        } else {
            $path = Course::where('id', $courseId)->first()->image_path;
        }

        Course::where('id', $courseId)->update([
            'title' => $request->title, 'description' => $request->description,
            'estimated_total_time' => $request->hour, 'price' => $request->price,
            'sub_category_id' => $request->subCategoryId, 'image_path' => $path
        ]);

        // Return Success
        return response()->json(['success' => "Successfully updated."]);
    }

    // Create New Module
    public function createModule(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'moduleContent' => ['required', 'string']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        if ($request->moduleNo == 0) {
            $moduleNo = 1;
        } else {
            $moduleNo = $request->moduleNo + 1;
        }

        // Create New Module
        $module = new Module;
        $module->title = $request->title;
        $module->description = $request->description;
        $module->data = $request->moduleContent;
        $module->course_id = $request->courseId;
        $module->module_no = $moduleNo;
        $module->save();

        return response()->json(['success' => "Course module created successfully."], 200);
    }

    // Update Module
    public function updateModule(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'title' => ['required', 'string', 'min:5', 'max:100'],
            'description' => ['required', 'string', 'max:255'],
            'moduleContent' => ['required', 'string']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $moduleId = $request->moduleId;

        Module::where('id', $moduleId)->update([
            'title' => $request->title, 'description' => $request->description,
            'data' => $request->moduleContent
        ]);

        // Return Success
        return response()->json(['success' => "Successfully updated."]);
    }
}
