<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule as ValidationRule;

class AuthController extends Controller
{
    public function loginIndex()
    {
        return view('auth.login');
    }

    public function registerIndex()
    {
        return view('auth.register');
    }

    // Create A New User
    public function store(Request $request)
    {
        if ($request->role == "student") {
            // Form data Validation
            $validator = Validator::make($request->all(), [
                'firstName' => ['required', 'string', 'max:60'],
                'lastName'  => ['required', 'string', 'max:60'],
                'email'     => ['required', 'string', 'max:100', ValidationRule::unique('users')],
                'password'  => ['required', 'string', 'min:6', 'max:20'],
                'studentMobile' => ['required', 'string', 'max:20'],
                'dateOfBirth' => ['required', 'date'],
                'qualification' => ['required', 'string', 'max:20']
            ]);

            // Return Validation Errors
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            // Hash Password
            $hashedPassword = Hash::make($request->password);

            // Create New User
            $user = new User;
            $user->email = $request->email;
            $user->password = $hashedPassword;
            $user->role = "student";
            $user->status = true;
            $user->save();

            // Create New Student
            $student = new Student;
            $student->first_name = $request->firstName;
            $student->last_name = $request->lastName;
            $student->date_of_birth = $request->dateOfBirth;
            $student->mobile = $request->studentMobile;
            $student->highest_education = $request->qualification;
            $student->user_id = $user->id;
            $student->save();
        } elseif ($request->role == "instructor") {
            // Form data Validation
            $validator = Validator::make($request->all(), [
                'firstName' => ['required', 'string', 'max:60'],
                'lastName'  => ['required', 'string', 'max:60'],
                'email'     => ['required', 'string', 'max:100', ValidationRule::unique('users')],
                'password'  => ['required', 'string', 'min:6', 'max:20'],
                'instructorMobile' => ['required', 'string', 'max:20'],
                'nic' => ['required', 'string', 'max:20'],
                'city' => ['required', 'string', 'max:40'],
                'bio' => ['required', 'string', 'max:300']
            ]);

            // Return Validation Errors
            if ($validator->fails()) {
                return response()->json(['error' => $validator->messages()], 200);
            }

            // Hash Password
            $hashedPassword = Hash::make($request->password);

            // Create New User
            $user = new User;
            $user->email = $request->email;
            $user->password = $hashedPassword;
            $user->role = "instructor";
            $user->status = true;
            $user->save();

            // Create New Instructor
            $instructor = new Instructor();
            $instructor->first_name = $request->firstName;
            $instructor->last_name = $request->lastName;
            $instructor->city = $request->city;
            $instructor->mobile = $request->instructorMobile;
            $instructor->nic = $request->nic;
            $instructor->bio = $request->bio;
            $instructor->isVerified = false;
            $instructor->user_id = $user->id;
            $instructor->save();
        }

        // Login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            $user = User::where("email", $request->email)->first();
            return response()->json(['message' => "Successfully Logged In", 'role' => $user->role], 200);
        }
    }


    public function login(Request $request)
    {
        // Form data Validation
        $validator = Validator::make($request->all(), [
            'email'     => ['required', 'email'],
            'password'  => ['required', 'string', 'min:6', 'max:20']
        ]);

        // Return Validation Errors
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        // Check For Email Account
        $user = User::where("email", $request->email)->first();

        // Email Not Found
        if ($user == NULL){
            return response()->json(['credentials' => "email"], 200);
        }

        // Password Check
        if (!Hash::check($request->password, $user->password)) {
            return response()->json(['credentials' => "password"], 200);
        }

        // Login
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1])) {
            return response()->json(['message' => "Successfully Logged In", 'role' => $user->role], 200);
        }
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
