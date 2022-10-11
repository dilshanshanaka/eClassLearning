<?php

namespace App\Http\Controllers;

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
}
