<?php

namespace App\Http\Controllers;

use App\Models\Instructor;
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

        return view('instructor.dashboard', compact('email', 'instructor'));
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
}
