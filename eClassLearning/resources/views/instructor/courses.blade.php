@extends('layouts.instructor')

@php

$title = "courses";

@endphp

@section('content')
<!-- Content Starts -->

<div>
    <h2 class="text-2xl font-bold">My Courses</h2>

    <div class="course-list mt-6 mb-8 flex space-x-6 mx-auto">
        @foreach($courses as $course)
        <!-- Single Course Starts -->
        <div class="basis-1/3 w-full max-w-sm bg-white rounded-xl shadow-lg">
            <a href="#">
                <img class="rounded-t-lg h-36 w-full" src="{{ asset($course->image_path) }}" alt="course image">
            </a>
            <div class="px-3 py-4">
                <a href="#">
                    <h5 class="text-md font-bold tracking-tight text-gray-900">{{ $course->title }}</h5>
                </a>

                <h6 class="text-sm text-gray-500 text-center mt-2">{{ $course->mainCategory->title }} > {{ $course->subCategory->title }}</h6>

                <div class="grid gap-6 my-2 md:grid-cols-2">
                    <div class="flex items-center justify-center float-left">
                        <svg aria-hidden="true" class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>First star</title>
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Second star</title>
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Third star</title>
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Fourth star</title>
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <svg aria-hidden="true" class="w-4 h-4 text-yellow-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Fifth star</title>
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                        <span class="text-sm font-mono text-gray-400">(12)</span>
                    </div>
                    <h3 class="text-md font-bold text-gray-900 text-right">LKR {{ number_format($course->price, 2, ',', '.')  }}</h3>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <h6 class="text-sm text-gray-700 mt-2">Status: <span class="text-blue-600">{{ $course->status }}</span></h6>

                    @if($course->isVerified == true)
                    <h6 class="text-sm text-right text-green-700 mt-2"><i class="fa-regular fa-circle-check"></i> Verified</h6>
                    @else
                    <h6 class="text-sm text-right text-gray-700 mt-2">Not Verified</h6>
                    @endif
                </div>

                <h4 class="text-gray-700 my-2 font-medium">Enrolled Studdents : 120</h4>

                <div class="grid gap-2 md:grid-cols-3 mt-3 text-center">
                    <a type="button" href="" type="button" class="py-2 px-3 bg-gradient-to-r from-green-400 to-green-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-green-700 hover:to-green-400 transition duration-300 w-full">
                        View
                    </a>
                    <a type="button" href="{{ route('instructor.course', $course->id) }}" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                        Details
                    </a>
                    <a type="button" href="" type="button" class="py-2 px-3 bg-gradient-to-r from-red-400 to-red-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-red-700 hover:to-red-400 transition duration-300 w-full">
                        Delete
                    </a>
                </div>
            </div>
        </div>
        <!-- Single Course Ends -->
        @endforeach
    </div>

</div>

<!-- Content Ends -->
@endsection