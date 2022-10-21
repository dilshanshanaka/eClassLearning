<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AskQuestion;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use App\Models\StudentEnrolment;
use App\Models\Purchase;
use App\Models\QuestionAnswer;
use App\Models\Review;
use App\Models\StudentModule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    // Index
    public function show()
    {
        $userId = Auth::id();

        $student = Student::where('user_id', Auth::id())->first();

        $email = Auth::user()->email;

        return view('student.dashboard', compact('email', 'student'));
    }

    // Profile
    public function profile()
    {
        $userId = Auth::id();

        $student = Student::where('user_id', Auth::id())->first();

        $email = Auth::user()->email;

        return view('student.profile', compact('email', 'student'));
    }

    // Update Student Data
    public function updateStudent(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'firstName' => ['required', 'string', 'max:60'],
            'lastName'  => ['required', 'string', 'max:60'],
            'mobile' => ['required', 'string', 'max:20'],
            'dateOfBirth' => ['required', 'date'],
            'qualification' => ['required', 'string', 'max:20']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        Student::where('user_id', Auth::id())
            ->update([
                'first_name' => $request->firstName, 'last_name' => $request->lastName,
                'mobile' => $request->mobile, 'highest_education' => $request->qualification,
                'date_of_birth' => $request->dateOfBirth
            ]);


        return response()->json(['message' => "Successfully updated."], 200);
    }


    // Upload Profile Picture
    public function profileImage(Request $request)
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
        $request->file('profileImageInput')->move(public_path('images/student'), $fileName);

        // Saved Path
        $path = "images/student/" . $fileName;

        // Update Profile Path
        Student::where('user_id', Auth::id())
            ->update(['profile_image_path' => $path]);

        // Return Success
        return response()->json(['success' => "Profile image upload success."]);
    }


    // Course Enroll
    public function enroll(Request $request)
    {
        // Create New Enrolment
        $enroll = new StudentEnrolment;
        $enroll->course_id = $request->courseId;
        $enroll->user_id = Auth::id();
        $enroll->status = "enrolled";
        $enroll->save();

        $studentId = Student::where("user_id", Auth::id())->first()->id;
        $instructorId = Course::where("id", $request->courseId)->first()->instructor_id;

        // Purchase
        $purchase = new Purchase;
        $purchase->student_id = $studentId;
        $purchase->instructor_id = $instructorId;
        $purchase->type = "course";
        $purchase->description = $request->courseTitle;
        $purchase->amount = $request->amount;
        $purchase->course_id = $request->courseId;
        $purchase->status = "paid";
        $purchase->save();

        return response()->json(['success' => "Sucessfully Added"], 200);
    }



    public function addNewAppointment(Request $request)
    {

        $studentId = Student::where('user_id', Auth::id())->first()->id;

        // Form data Validation
        $validator = Validator::make($request->all(), [
            'appointmentDate' => ['required', 'date'],
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $appointment = new Appointment;
        $appointment->date = $request->appointmentDate;
        $appointment->start_time = $request->startTime;
        $appointment->end_time = $request->endTime;
        $appointment->details = "pending";
        $appointment->instructor_id = $request->instructorId;
        $appointment->student_id = $studentId;
        $appointment->save();

        // Purchase
        $purchase = new Purchase;
        $purchase->student_id = $studentId;
        $purchase->instructor_id = $request->instructorId;
        $purchase->type = "appointment";
        $purchase->description = $request->startTime . ' to' .  $request->endTime . ' Appoinment ';
        $purchase->amount = $request->chargePerHour;
        $purchase->appointment_id = $appointment->id;
        $purchase->status = "paid";
        $purchase->save();

        return response()->json(['success' => "successfully added"], 200);
    }

    public function courses()
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $courses = DB::table('student_enrolments')
            ->join('courses', 'courses.id', '=', 'student_enrolments.course_id')
            ->select('courses.*')
            ->where('student_enrolments.user_id', $userId)
            ->paginate(2);

        return view('student.courses', compact('email', 'student', 'courses'));
    }

    public function questions()
    {
        $userId = Auth::id();

        $student = Student::where('user_id', Auth::id())->first();

        $email = Auth::user()->email;

        $questions = DB::table('ask_questions')
            ->join('courses', 'courses.id', '=', 'ask_questions.course_id')
            ->select('ask_questions.*', 'courses.title')
            ->where('ask_questions.student_id', $student->id)
            ->latest()->paginate(10);

        return view('student.questions', compact('email', 'student', 'questions'));
    }

    public function askQuestion($courseId)
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $course = DB::table('courses')
            ->join('instructors', 'instructors.id', '=', 'courses.instructor_id')
            ->select('courses.*', 'instructors.first_name', 'instructors.last_name', 'instructors.profile_image_path')
            ->where('courses.id', $courseId)
            ->first();

        return view('student.ask-a-question', compact('email', 'student', 'course'));
    }

    public function createQuestion(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'question'  => ['required', 'string', 'max:300']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $student = Student::where('user_id', Auth::id())->first();

        $question = new AskQuestion;
        $question->student_id = $student->id;
        $question->course_id = $request->courseId;
        $question->question = $request->question;
        $question->status = "pending";
        $question->save();

        return response()->json(['success' => "successfully added"], 200);
    }


    public function purchases()
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $purchases = Purchase::where('student_id', $student->id)->latest()->paginate(15);

        return view('student.purchases', compact('email', 'student', 'purchases'));
    }

    public function courseReview($courseId)
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $course = Course::where('id', $courseId)->first();

        return view('student.review', compact('email', 'student', 'course'));
    }

    public function review(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'stars'  => ['required', 'int', 'min:1', 'max:5'],
            'review'  => ['required', 'string', 'max:255'],
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $student = Student::where('user_id', Auth::id())->first();

        $review = new Review;
        $review->student_id = $student->id;
        $review->course_id = $request->courseId;
        $review->review = $request->review;
        $review->stars = $request->stars;
        $review->save();

        return response()->json(['success' => "successfully added"], 200);
    }

    // Appointments
    public function appointments()
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $appointments = DB::table('appointments')
            ->join('instructors', 'appointments.instructor_id', '=', 'instructors.id')
            ->join('students', 'appointments.student_id', '=', 'students.id')
            ->select(
                'appointments.*',
                'instructors.first_name as instructor_first_name',
                'instructors.last_name as instructor_last_name',
                'students.first_name as student_first_name',
                'students.last_name as student_last_name'
            )
            ->where('appointments.student_id', $student->id)
            ->latest()->paginate(10);

        return view('student.appointments', compact('email', 'student', 'appointments'));
    }


    // Single Course
    public function course($courseId)
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $modules = Module::where('course_id', $courseId)->orderBy('module_no')->get();
        $course = Course::where('id', $courseId)->first();

        $studentOngoingdModule = DB::table('student_module_progress')
        ->select('student_module_progress.*')
        ->where('course_id', $courseId)
        ->where('status', "ongoing")
        ->where('student_id', $student->id)
        ->latest()->first()->module_id;

        if ($studentOngoingdModule == null) {
            $module = new StudentModule;
            $module->student_id = $student->id;
            $module->course_id = $courseId;
            $module->module_id = 1;
            $module->status = "ongoing";
            $module->save();

            $studentOngoingdModule = 1;
        }

        return view('student.course', compact('email', 'student', 'course', 'modules', 'studentOngoingdModule'));
    }

    public function content($courseId, $moduleNo)
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $modules = DB::table('modules')
        ->leftJoin('quizzes', 'modules.id', '=', 'quizzes.module_id')
        ->select(
            'modules.*',
            'quizzes.id as quiz',
        )
        ->where('modules.course_id', $courseId)
        ->get();


        $course = Course::where('id', $courseId)->first();

        $pageModule = Module::where('module_no', $moduleNo)->where('course_id', $courseId)->first();

        $finalModule = Module::where('module_no', $moduleNo)->where('course_id', $courseId)->latest()->first()->module_no;

        return view('student.content', compact('email', 'student', 'course', 'modules', 'pageModule', 'finalModule'));
    }

    public function lastCompletedModule($courseId)
    {
        $studentId = Student::where('user_id', Auth::id())->first()->id;

        $lastCompletedModule = DB::table('student_module_progress')
            ->select('student_module_progress.*')
            ->where('course_id', $courseId)
            ->where('status', "ongoing")
            ->where('student_id', $studentId)
            ->latest()->first();

        if ($lastCompletedModule == null) {
            $module = new StudentModule;
            $module->student_id = $studentId;
            $module->course_id = $courseId;
            $module->module_id = 1;
            $module->status = "ongoing";
            $module->save();

            return response()->json(['success' => 1], 200);
        }

        return response()->json(['success' => $lastCompletedModule], 200);
    }


    public function completeModule($moduleId)
    {


        // Change Status to Complete
        StudentModule::where('module_id', $moduleId)
            ->update([
                'status' => "completed"
            ]);

        return response()->json(['success' => "success"], 200);
    }

    public function quizzes($courseId, $quizId)
    {
        $userId = Auth::id();
        $student = Student::where('user_id', Auth::id())->first();
        $email = Auth::user()->email;

        $course = Course::where('id', $courseId)->first();

        $modules = DB::table('modules')
        ->leftJoin('quizzes', 'modules.id', '=', 'quizzes.module_id')
        ->select(
            'modules.*',
            'quizzes.id as quiz',
        )
        ->where('modules.course_id', $courseId)
        ->get();

        $quiz = DB::table('quizzes')
        ->leftJoin('modules', 'quizzes.module_id', '=', 'modules.id')
        ->select('quizzes.id', 'quizzes.type', 'modules.module_no')
        ->where('quizzes.id', $quizId)
        ->first();

        $questions = QuestionAnswer::where('quiz_id', $quiz->id)->get();

        $finalModule = Module::where('module_no', $quiz->module_no)->where('course_id', $courseId)->latest()->first()->module_no;

        return view('student.quiz', compact('email', 'student', 'course', 'modules', 'finalModule', 'questions', 'quiz'));

    }

    public function moduleQuestions($quizId)
    {
        $questions = QuestionAnswer::where('quiz_id', $quizId)->get();

        return response()->json(['success' => $questions], 200);
    }
}
