<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    // Get All Users
    public function allUsers()
    {
        $users = User::select('id', 'email', 'role', 'status', 'created_at', 'updated_at')->paginate(3);
        $totalUsers = User::count();

        return view('admin.users', compact('users', 'totalUsers'));
    }

    // Get All students
    public function students()
    {
        $students = DB::table('students')
            ->join('users', 'students.user_id', '=', 'users.id')
            ->select('students.*', 'users.email', 'users.role', 'users.status')
            ->paginate(3);

        $totalStudents = Student::count();

        return view('admin.students', compact('students', 'totalStudents'));

        // return response()->json(['data' => $students], 200);
    }

    // Get All Instructors
    public function instructors()
    {
        $instructors = DB::table('instructors')
            ->join('users', 'instructors.user_id', '=', 'users.id')
            ->select('instructors.*', 'users.email', 'users.role', 'users.status')
            ->paginate(3);

        $totalInstructors = Instructor::count();

        return view('admin.instructors', compact('instructors', 'totalInstructors'));
    }

    // Change User Status
    public function manageUserStatus(Request $request)
    {
        if ($request->status == "blocked") {
            $status = false;
        } else {
            $status = true;
        }

        User::where('id', $request->userId)
            ->update([
                'status' => $status
            ]);

        return response()->json(['data' => "Success"], 200);
    }

    // Change Instructor Verification
    public function changeInstructorVerification(Request $request)
    {
        if ($request->status == "verify") {
            $status = true;
        } else {
            $status = false;
        }

        Instructor::where('user_id', $request->userId)
            ->update([
                'isVerified' => $status
            ]);

        return response()->json(['data' => "Success"], 200);
    }

    // Get All Courses
    public function courses()
    {
        $courses = DB::table('courses')
            ->join('instructors', 'courses.instructor_id', '=', 'instructors.id')
            ->join('sub_categories', 'courses.sub_category_id', '=', 'sub_categories.id')
            ->join('main_categories', 'sub_categories.main_category_id', '=', 'main_categories.id')
            ->select(
                'courses.*',
                'instructors.first_name',
                'instructors.last_name',
                'sub_categories.title as sub_category',
                'main_categories.title as main_category'
            )
            ->paginate(10);

        $totalCourses = Course::count();
        $totalPublishedCourses = Course::where('status', 'published')->count();

        return view('admin.courses', compact('courses', 'totalCourses', 'totalPublishedCourses'));
    }

    // Change Course Status
    public function changeCourseStatus(Request $request)
    {

        Course::where('id', $request->courseId)
            ->update([
                'status' => $request->status
            ]);

        return response()->json(['data' => "Success"], 200);
    }
}
