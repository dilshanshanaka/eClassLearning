@extends('layouts.home')

@section('content')

<!-- Content Starts -->
<div class="content mt-12">
    <!-- Categories Starts -->
    <h4 class="text-center font-bold text-lg text-violet-800">CATEGORIES</h4>
    <h2 class="text-center font-bold text-4xl text-gray-800 mt-3">Explore Our Course Categories</h2>

    <div class="mt-14 flex justify-between space-x-8 md:max-w-6xl mx-auto">
        @foreach ($mainCategories as $mainCategory)
        <!-- Single Category Starts -->
        <div class="basis-1/2 md:basis-1/6 shadow-lg p-3 rounded-md bg-purple-100 text-center ">
            <img class="w-96 rounded-md mb-2" src="{{ asset($mainCategory->image_path) }}" alt="{{ $mainCategory->title }}">
            <a class="text-slate-900 text-md font-semibold" href="course-category/{{ $mainCategory->id }}">{{ $mainCategory->title }}</a>
        </div>
        <!-- Single Category Starts -->
        @endforeach
    </div>
    <!-- Categories Ends -->

    <div class="courses mt-20">
        <!-- Categories Starts -->
        <h4 class="text-center font-bold text-lg text-violet-800">OUR COURSES</h4>
        <h2 class="text-center font-bold text-4xl text-gray-800 mt-3">Most Popular Courses</h2>


    </div>

</div>

<div class=" text-center h-96">

</div>
<!-- Content Ends -->

@endsection