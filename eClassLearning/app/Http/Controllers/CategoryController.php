<?php

namespace App\Http\Controllers;
use App\Models\MainCategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Main Categories
    public function showMainCategories()
    {
        $mainCategories = MainCategory::all();

        dd($mainCategories);
    }
}
