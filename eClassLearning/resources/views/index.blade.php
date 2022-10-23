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
        <div class="basis-1/2 md:basis-1/6 shadow-lg p-3 rounded-md bg-purple-100 text-center max">
            <img class="w-96 rounded-md mb-2 h-36 w-fill" src="{{ asset($mainCategory->image_path) }}" alt="{{ $mainCategory->title }}">
            <a class="text-slate-900 text-md font-semibold" href="courses/main-category/{{ $mainCategory->id }}">{{ $mainCategory->title }}</a>
        </div>
        <!-- Single Category Starts -->
        @endforeach
    </div>
    <!-- Categories Ends -->

    <div class="courses mt-20">
        <!-- Popular Courses Starts -->
        <h4 class="text-center font-bold text-lg text-violet-800">OUR COURSES</h4>
        <h2 class="text-center font-bold text-4xl text-gray-800 mt-3">Most Popular Courses</h2>

        <div class="mt-14 flex justify-between space-x-6 md:max-w-6xl mx-auto">
            @foreach($courses as $course)
            <!-- Single Course Starts -->
            <div class="basis-1/2 md:basis-1/6 w-full max-w-sm bg-white rounded-xl shadow-lg">
                <a href="#">
                    <img class="rounded-t-lg h-36 w-full" src="{{ asset($course->image_path) }}" alt="course image">
                </a>
                <div class="px-3 py-4">
                    <a href="#">
                        <h5 class="text-md font-bold text-center tracking-tight text-gray-900">{{ $course->title }}</h5>
                    </a>

                    <h6 class="text-sm text-gray-500 text-center mt-2">{{ $course->main_category }} <br> {{ $course->sub_category }}</h6>


                    <h3 class="text-xl font-bold text-gray-900 text-center">LKR {{ number_format($course->price, 2, ',', '.')  }}</h3>

                    <div class="stars my-3 text-center">
                        <h3 class="text-yellow-500 text-md">
                            @php $stars = round($course->stars); @endphp

                            @for($i=0; $i < 5; $i++) @php if($stars> 0){

                                @endphp
                                <i class="fa-solid fa-star"></i>
                                @php $stars--;
                                }else{
                                @endphp

                                <i class="fa-regular fa-star"></i>
                                @php } @endphp
                                @endfor
                        </h3>
                    </div>

                    <div class="flex justify-center items-center mt-2">
                        <a href="/course/{{ $course->id }}" type="button" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full text-center">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <!-- Single Course Ends -->
            @endforeach
        </div>
        <!-- Popular Courses Ends -->

    </div>

    <div class="instrctors mt-20 mb-20">
        <!-- Popular Courses Starts -->
        <h4 class="text-center font-bold text-lg text-violet-800">INSTRUCTORS</h4>
        <h2 class="text-center font-bold text-4xl text-gray-800 mt-3">Top Instructors</h2>

        <div class="mt-14 flex space-x-6 md:max-w-6xl mx-auto">
            @foreach($instructors as $instructor)
            <!-- Single Instructors Starts -->
            <div class="basis-1/2 md:basis-1/6 w-full max-w-sm">
                <a href="/public/instructor/{{ $instructor->id }}">
                    @php
                    $imagePath = "images/blank-profile-picture.png";

                    if ($instructor->profile_image_path != NULL){
                    $imagePath = $instructor->profile_image_path;
                    }
                    @endphp

                    <img id="profileImage" class="w-[150px] h-[150px] rounded-full mx-auto my-3" src="{{ asset($imagePath) }}" alt="profile image">

                </a>

                <a href="/public/instructor/{{ $instructor->id }}">
                    <h4 class="mt-4 text-center font-bold text-xl text-gray-700">{{ $instructor->first_name.' '.$instructor->last_name }}</h4>
                </a>
            </div>
            <!-- Single Instructors Ends -->
            @endforeach
        </div>
    </div>

</div>

<!-- Content Ends -->

@endsection