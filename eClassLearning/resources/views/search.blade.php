@extends('layouts.default')

@section('content')

<div class="py-20 bg-gray-100 text-center">
    <h1 class="text-3xl uppercase text-gray-700 font-bold ">Search Results for "<span class="italic">{{ $searchTerm }}</span>"</h1>

    <!-- Breadcrumb Starts -->
    <nav class="flex pt-2 justify-center" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <span class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                    <i class="fa-solid fa-house-user"></i>&emsp;Home
                </span>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 capitalize">Courses</span>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 capitalize">Search</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- Breadcrumb Ends -->
</div>

<div class="px-20 pt-12 pb-10">
    @if($noResults)
        <h4 class="text-center text-lg text-gray-700 font-md">No Results Found</h4>
    @endif
    <div class="flex">
        @foreach($courses as $course)
        <!-- Single Course Starts -->
        <div class="basis-1/4 w-full max-w-sm bg-white rounded-xl shadow-lg">
            <a href="#">
                <img class="rounded-t-lg h-36 w-full" src="{{ asset($course->image_path) }}" alt="course image">
            </a>
            <div class="px-3 py-4">
                <a href="#">
                    <h5 class="text-md font-bold tracking-tight text-gray-900">{{ $course->title }}</h5>
                </a>

                <h6 class="text-sm text-gray-500 text-center mt-2">{{ $course->main_category }} > {{ $course->sub_category }}</h6>

                <div class="grid gap-6 my-2 md:grid-cols-2">
                    <div class="flex items-center justify-center float-left">

                        <span class="text-sm font-mono text-gray-400">(12)</span>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 text-right">LKR {{ number_format($course->price, 2, ',', '.')  }}</h3>
                </div>

                <div class="grid gap-6 md:grid-cols-2">
                    <h6 class="text-sm text-gray-700 mt-2">Status: <span class="text-blue-600">{{ $course->status }}</span></h6>

                    @if($course->isVerified == true)
                    <h6 class="text-sm text-right text-green-700 mt-2"><i class="fa-regular fa-circle-check"></i> Verified</h6>
                    @else
                    <h6 class="text-sm text-right text-gray-700 mt-2">Not Verified</h6>
                    @endif
                </div>

                <div class="flex items-center mt-3">
                    <button id="loginSubmit" type="button" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                        View
                    </button>
                </div>
            </div>
        </div>
        <!-- Single Course Ends -->
        @endforeach
    </div>
    <div class="d-flex justify-content-center pt-14 pb-4 px-4 basis-full">
        {!! $courses->links() !!}
    </div>
</div>

@endsection