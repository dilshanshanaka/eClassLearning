<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // Index
    public function index()
    {
        // Main Categories
        $mainCategories = MainCategory::all();

        return view('index', compact('mainCategories'));
    }

    // Search Course By Title
    public function search(Request $request)
    {
        $searchTerm = $request->term;

        $courses = Course::query()
        ->where('title', 'LIKE', "%{$searchTerm}%")
        ->orWhere('description', 'LIKE', "%{$searchTerm}%")
        ->get();

        return print_r($courses);
    }
}
