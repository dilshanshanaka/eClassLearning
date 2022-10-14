<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CourseVerifierController extends Controller
{

    public function dashboard()
    {
        return view('course-verifier.dashboard');
    }

    public function changePasswordView()
    {
        return view('course-verifier.change-password');

    }
}
