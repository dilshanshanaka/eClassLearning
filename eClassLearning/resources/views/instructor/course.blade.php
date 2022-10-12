@extends('layouts.instructor')

@php

$title = "course";

@endphp

@section('content')
<!-- Content Starts -->

<!-- Course Basic Info Start -->
<div class="flex">
    <!-- Course Image Starts -->
    <div class="basis-1/2 p-10">
        <img class="w-full h-72 rounded-lg" src="{{ asset($course->image_path) }}" alt="course image">
    </div>
    <!-- Course Image Ends -->

    <!-- Course Details Starts -->
    <div class="basis-1/2 pt-10 md:pr-10">
        <h2 class="text-gray-800 text-4xl font-bold">{{ $course->title }}</h2>
        <h6 class="text-md text-gray-500 mt-3">{{ $course->mainCategory->title }} > {{ $course->subCategory->title }}</h6>
        <div class="grid gap-6 md:grid-cols-2">
            <h6 class="text-sm text-gray-700 mt-2">Status: <span class="text-blue-600">{{ $course->status }}</span></h6>

            @if($course->isVerified == true)
            <h6 class="text-sm text-right text-green-700 mt-2"><i class="fa-regular fa-circle-check"></i> Verified</h6>
            @else
            <h6 class="text-sm text-right text-gray-700 mt-2">Not Verified</h6>
            @endif
        </div>
        <p class="mt-2 text-justify text-gray-700">{{ $course->description }}</p>

        <div class="stars my-3">
            <h3 class="text-yellow-500 text-md">
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-regular fa-star-half-stroke"></i>
                <i class="fa-regular fa-star"></i>
            </h3>
        </div>



        <div class="my-3 grid gap-6 md:grid-cols-2">
            <h6 class="text-md text-gray-600 mt-3">Duration : {{ $course->estimated_total_time }} hours </h6>

            <h3 class="text-2xl font-bold text-gray-800 text-right">LKR {{ number_format($course->price, 2, '.', ',')  }}</h3>
            <!-- <div class="ml-auto">

            </div> -->
        </div>


        <div class="my-3 flex items-right space-x-3">

            <a type="button" href="{{ route('instructor.editcourse', $course->id) }}" type="button" class="text-center py-2 px-3 bg-gradient-to-r from-sky-500 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-sky-700 hover:to-sky-500">
                Edit Course
            </a>
            <a type="button" href="" type="button" class="text-center py-2 px-3 bg-gradient-to-r from-red-500 to-red-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-red-700 hover:to-red-500 ">
                Delete
            </a>
        </div>

    </div>
    <!-- Course Details Ends -->

</div>
<!-- Course Basic Info Ends -->

<div class="mx-10 mt-4 pb-20">
    <hr>

    <div class="flex my-8 items-center space-x-3">
        <h3 class="text-gray-700 text-3xl font-bold">
            Module List
        </h3>
        <a type="button" href="{{ route('instructor.newmodule', $course->id) }}" type="button" class="text-center text-sm p-2 bg-gradient-to-r from-emerald-500 to-emerald-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-emerald-700 hover:to-emerald-500">
            New Module
        </a>
        <a type="button" href="" type="button" class="text-center text-sm p-2 bg-gradient-to-r from-emerald-500 to-emerald-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-emerald-700 hover:to-emerald-500">
            Add Final Quiz
        </a>
    </div>


    <div class="px-10">
        <ol class="relative border-l border-gray-200">
            @foreach($modules as $module)
            <!-- Single Course Module Starts -->
            <li class="mb-10 ml-4">
                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white"></div>
                <time class="mb-1 text-sm font-normal leading-none text-gray-400">Module {{ $module->module_no }}</time>
                <h3 class="text-lg font-semibold text-gray-900">{{ $module->title }}</h3>

                <h3 class="ml-8 text-gray-600 text-justify md:w-2/3">{{ $module->description }}</h3>

                <div class="flex mt-6 space-x-4">
                    <a type="button" href="{{ route('instructor.editmodule', ['courseId'=>$course->id, 'moduleId'=> $module->id]) }}" type="button" class="text-center text-sm p-2 bg-gradient-to-r from-blue-500 to-blue-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-blue-500">
                        Edit Lesson
                    </a>
                    <a type="button" href="" type="button" class="text-center text-sm p-2 bg-gradient-to-r from-emerald-500 to-emerald-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-emerald-700 hover:to-emerald-500">
                        Add Quiz
                    </a>
                </div>
            </li>
            <!-- Single Course Module Ends -->
            @endforeach
        </ol>

    </div>
</div>


<!-- Content Ends -->
@endsection