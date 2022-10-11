<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

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
        $request->file('profileImageInput')->move(public_path('images/student'), $fileName);

        // Saved Path
        $path = "images/student/" . $fileName;

        // Update Profile Path
        Student::where('user_id', Auth::id())
            ->update(['profile_image_path' => $path]);

        // Return Success
        return response()->json(['success' => "Profile image upload success."]);
    }
}
