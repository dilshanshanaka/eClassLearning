<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Instructor;
use App\Models\MainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    // Index
    public function index()
    {
        // Main Categories
        $mainCategories = MainCategory::all();

        $instructors = Instructor::latest()->limit(9)->get();

        $courses = DB::table('courses')
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
        )->groupBy('courses.id')
        ->limit(6)->get();


        return view('index', compact('mainCategories', 'instructors', 'courses'));
    }

    // Search Course By Title
    public function search(Request $request)
    {
        $noResults = false;
        $searchTerm = $request->term;

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
        )->where('courses.title', 'LIKE', "%{$searchTerm}%")
        ->orWhere('courses.description', 'LIKE', "%{$searchTerm}%")
        ->paginate(4);

        
        if($courses->total() == 0){
            $noResults = true;
        }

        return view('search', compact('courses', 'searchTerm', 'noResults'));;
    }
}
