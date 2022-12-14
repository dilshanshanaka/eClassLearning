<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Module;
use App\Models\QuestionAnswer;
use App\Models\Quiz;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    // Public Course View
    public function publicCourse($courseId)
    {

        $course = DB::table('courses')
            ->join('instructors', 'courses.instructor_id', '=', 'instructors.id')
            ->join('sub_categories', 'courses.sub_category_id', '=', 'sub_categories.id')
            ->join('main_categories', 'sub_categories.main_category_id', '=', 'main_categories.id')
            ->leftJoin('reviews', 'courses.id', '=', 'reviews.course_id')
            ->select(
                DB::raw('avg(reviews.stars) as stars'),
                'courses.*',
                'instructors.first_name',
                'instructors.last_name',
                'sub_categories.title as sub_category',
                'main_categories.title as main_category'
            )->groupBy('courses.id')->where('courses.id', $courseId)->first();


        if ($course == null) {
            return abort(404);
        }

        $modules = Module::where('course_id', $courseId)->orderBy('module_no')->get();

        return view('course', compact('course', 'modules'));
    }

    // GET Course Data in JSON
    public function apiCourse($courseTitle)
    {
        $course = DB::table('courses')
            ->join('sub_categories', 'courses.sub_category_id', '=', 'sub_categories.id')
            ->join('main_categories', 'sub_categories.main_category_id', '=', 'main_categories.id')
            ->select(
                'courses.*',
                'sub_categories.title as sub_category',
                'main_categories.title as main_category'
            )->where('courses.title', $courseTitle)->first();

        return response()->json($course);
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

    // Create Quiz
    public function createQuiz(Request $request)
    {

        // Create New Quiz
        $quiz = new Quiz;
        $quiz->type = $request->type;
        $quiz->course_id = $request->courseId;
        $quiz->module_id = $request->moduleNo;
        $quiz->save();


        // Insert Question and Answers
        foreach ($request->quizItems as $quizItem) {
            $qa = new QuestionAnswer;
            $qa->question = $quizItem['question'];
            $qa->answer_one = $quizItem['answerOne'];
            $qa->answer_two = $quizItem['answerTwo'];
            $qa->answer_three = $quizItem['answerThree'];
            $qa->answer_four = $quizItem['answerFour'];
            $qa->correct_answer_no = $quizItem['correctAnswer'];
            $qa->quiz_id = $quiz->id;
            $qa->save();
        }

        return response()->json(['success' => 'Quiz added successfully.'], 200);
    }
}
