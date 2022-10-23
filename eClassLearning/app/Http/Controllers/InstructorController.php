<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AskQuestion;
use Illuminate\Support\Facades\DB;
use App\Models\Course;
use App\Models\Withdraw;
use App\Models\Instructor;
use App\Models\InstructorAppointment;
use App\Models\MainCategory;
use App\Models\Module;
use App\Models\Purchase;
use App\Models\Student;
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

        $totalCourses = DB::table('courses')->where('instructor_id', $instructor->id)->count();
        $totalAppointments = DB::table('appointments')->where('instructor_id', $instructor->id)->count();
        $totalSales = DB::table('purchases')->where('instructor_id', $instructor->id)->sum('amount');

        $purchases = Purchase::where('instructor_id', $instructor->id)->latest()->limit(2)->get();
        $courses = Course::where('instructor_id', $instructor->id)->latest()->limit(2)->get();

        return view('instructor.dashboard', compact('email', 'instructor', 'courses', 'purchases', 'totalAppointments' , 'totalCourses', 'totalSales'));
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
    public function createQuizView($courseId, $moduleNo = null)
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $course = Course::where('id', $courseId)->first();
        $module = Module::where('course_id', $courseId)->latest()->first();

        return view('instructor.new-quiz', compact('email', 'instructor', 'course', 'moduleNo'));
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


    // Course Detailed View
    public function course($courseId)
    {
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $modules = Module::where('course_id', $courseId)->orderBy('module_no')->get();

        $course = Course::where('id', $courseId)->first();

        return view('instructor.course', compact('instructor', 'email', 'course', 'modules'));
    }


    public function appointments()
    {
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $instructorAppointment = InstructorAppointment::where('instructor_id', $instructor->id)->first();
        $email = Auth::user()->email;
        $appointments = DB::table('appointments')
            ->join('students', 'appointments.student_id', '=', 'students.id')
            ->select('appointments.*', 'students.first_name', 'students.last_name')
            ->where('appointments.instructor_id', $instructor->id)
            ->paginate(10);

        return view('instructor.appointments', compact('instructor', 'email', 'appointments', 'instructorAppointment'));
    }

    public function changeAvailability(Request $request)
    {
        $instructor = Instructor::where('user_id', Auth::id())->first()->id;

        if ($request->status == "available") {
            $status = false;
        } else {
            $status = true;
        }

        InstructorAppointment::where('instructor_id', $instructor)
            ->update([
                'status' => $status
            ]);

        return response()->json(['data' => "Success"], 200);
    }

    public function addAvailability(Request $request)
    {
        $instructor = Instructor::where('user_id', Auth::id())->first()->id;

        // Form data Validation
        $validator = Validator::make($request->all(), [
            'startTime' => ['required'],
            'endTime'  => ['required'],
            'charge' => ['required', 'numeric'],
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $instructorAvailability = new InstructorAppointment;
        $instructorAvailability->instructor_id = $instructor;
        $instructorAvailability->start_time = $request->startTime;
        $instructorAvailability->end_time = $request->endTime;
        $instructorAvailability->charge_per_hour = $request->charge;
        $instructorAvailability->status = true;
        $instructorAvailability->save();

        return response()->json(['success' => "successfully added"], 200);
    }

    public function updateAvailability(Request $request)
    {

        // Form data Validation
        $validator = Validator::make($request->all(), [
            'startTime' => ['required'],
            'endTime'  => ['required'],
            'charge' => ['required', 'numeric'],
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $instructor = Instructor::where('user_id', Auth::id())->first()->id;

        InstructorAppointment::where('instructor_id', $instructor)
            ->update([
                'start_time' => $request->startTime,
                'end_time' => $request->endTime,
                'charge_per_hour' => $request->charge,
            ]);

        return response()->json(['data' => "Success"], 200);
    }

    public function publicInstructor($instructorId)
    {
        $instructor = Instructor::where('id', $instructorId)->first();

        $instructorAppointment = InstructorAppointment::where('instructor_id', $instructorId)->first();

        if ($instructorAppointment == null) {
            $instructorAppointment = null;
            $slots = null;
        } else {
            $start = date('H:i', strtotime($instructorAppointment->start_time));
            $end = $instructorAppointment->end_time;

            $startTime = strtotime($start);
            $endTime = strtotime($end);

            $timefarme = $endTime - $startTime;

            $timeSlots = $timefarme / 3600;

            $slots = [];

            for ($i =  1; $i <= $timeSlots; $i++) {
                $time = strtotime($start) + 60 * 60;
                $end = date('H:i', $time);

                $slot = array("value" => $i, "start_time" => $start, "end_time" => $end);
                array_push($slots, $slot);

                $start = $end;
            }
        }

        $userRole = "guest";



        if (Auth::check()) {
            $userRole = Auth::user()->role;
        }

        return view('instructor-public', compact('instructor', 'userRole', 'instructorAppointment', 'slots'));
    }

    public function appointmentAvailability($instructorId)
    {
        $instructorAppointment = InstructorAppointment::where('instructor_id', $instructorId)->first();

        $start = date('H:i', strtotime($instructorAppointment->start_time));
        $end = $instructorAppointment->end_time;

        $startTime = strtotime($start);
        $endTime = strtotime($end);

        $timefarme = $endTime - $startTime;

        $timeSlots = $timefarme / 3600;

        $slots = [];

        for ($i =  1; $i <= $timeSlots; $i++) {
            $time = strtotime($start) + 60 * 60;
            $end = date('H:i', $time);

            $slot = array("value" => $i, "start_time" => $start, "end_time" => $end);
            array_push($slots, $slot);

            $start = $end;
        }

        return response()->json(['data' => $slots], 200);
    }


    public function withdraw()
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();

        $sales = DB::table('purchases')->where('purchases.instructor_id', $instructor->id)->sum('amount');
        $earnings = $sales - ($sales * 10 / 100);

        $totalPendingWithdraw = DB::table('withdrawals')
            ->where('withdrawals.instructor_id', $instructor->id)
            ->where('withdrawals.status', "pending")
            ->sum('amount');

        $approvedWithdrawal = DB::table('withdrawals')
            ->where('withdrawals.instructor_id', $instructor->id)
            ->where('withdrawals.status', "approved")
            ->sum('amount');

        $balance = $earnings - $approvedWithdrawal;

        $withdrawals = Withdraw::where('instructor_id', $instructor->id)->latest()->paginate(8);

        // User Email
        $email = Auth::user()->email;
        $courses = Course::where('instructor_id', $instructor->id)->latest()->get();

        return view('instructor.withdraw', compact('email', 'instructor', 'courses', 'earnings', 'withdrawals', 'totalPendingWithdraw', 'balance'));
    }

    public function requestWithdraw(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'amount' => ['required', 'numeric', 'min:500'],
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $instructor = Instructor::where('user_id', Auth::id())->first();

        $withdrawRequest = new Withdraw;
        $withdrawRequest->instructor_id = $instructor->id;
        $withdrawRequest->amount = $request->amount;
        $withdrawRequest->status = "pending";
        $withdrawRequest->save();
        return response()->json(['success' => "successfully requested"], 200);
    }

    public function questions()
    {
        // Instructor Details
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $questions = DB::table('ask_questions')
            ->join('courses', 'courses.id', '=', 'ask_questions.course_id')
            ->select('ask_questions.*', 'courses.title')
            ->where('courses.instructor_id', $instructor->id)
            ->latest()->paginate(10);

        return view('instructor.questions', compact('email', 'instructor', 'questions'));
    }

    public function answerQuestions($questionId)
    {
        $instructor = Instructor::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $question = DB::table('ask_questions')
            ->join('courses', 'courses.id', '=', 'ask_questions.course_id')
            ->select('ask_questions.*', 'courses.title')
            ->where('ask_questions.id', $questionId)
            ->first();

        $student = Student::where('id', $question->student_id)->first();

        return view('instructor.answer', compact('email', 'instructor', 'question', 'student'));
    }

    public function updateQuestion(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'answer'  => ['required', 'string', 'max:300']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        AskQuestion::where('id', $request->questionId)
            ->update([
                'answer' => $request->answer,
                'status' => "answered"
            ]);

        return response()->json(['data' => "Success"], 200);
    }
}
