<?php

namespace App\Http\Controllers;

use App\Models\MainCategory;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Main Categories
    public function showMainCategories()
    {
        $mainCategories = MainCategory::all();

        dd($mainCategories);
    }

    // Sub Categories
    public function subCategories($mainCategoryId)
    {
        $subCategories = MainCategory::find($mainCategoryId)->subCategories;

        return response()->json(['subCategories' => $subCategories], 200);
    }

    public function courseByMainCategory($mainCategoryId)
    {

        $mainCategory = MainCategory::where('id', $mainCategoryId)->first();

        $mainCategories = MainCategory::select('id', 'title')->get();
        $subCategories = SubCategory::select('id', 'title', 'main_category_id')->where('main_category_id', $mainCategoryId)->get();

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
            )->where('main_categories.id', $mainCategoryId)->groupBy('courses.id')
            ->paginate(6);

        return view('category', compact('courses', 'mainCategory', 'mainCategories', 'subCategories'));
    }

    public function courseBySubCategory($mainCategoryId, $subCategoryId)
    {
        $category = DB::table('sub_categories')
            ->join('main_categories', 'sub_categories.main_category_id', '=', 'main_categories.id')
            ->select('sub_categories.title as sub_category', 'main_categories.title as main_category')
            ->where('sub_categories.id', $subCategoryId)->first();

        $mainCategories = MainCategory::select('id', 'title')->get();
        $subCategories = SubCategory::select('id', 'title', 'main_category_id')->where('main_category_id', $mainCategoryId)->get();

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
            )->where('courses.sub_category_id', $subCategoryId)
            ->paginate(2);

        return view('sub-category', compact('courses', 'category', 'mainCategories', 'subCategories'));
    }
}
