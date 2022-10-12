@extends('layouts.default')

@section('content')
<!-- Content Starts -->

<div class="content md:max-w-6xl shadow-2xl rounded-xl bg-white mx-auto my-12">
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
            @if($course->isVerified == true)
            <h3 class="text-md text-green-600 mt-2 font-semibold"><i class="fa-regular fa-circle-check"></i> eClassLearning Verified</h3>
            @endif
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

            <h6 class="text-md text-gray-600 mt-3">Duration : {{ $course->estimated_total_time }} hours </h6>


            <div class="my-3 grid gap-6 md:grid-cols-2">
                <h3 class="text-2xl font-bold text-gray-800 text-left">LKR {{ number_format($course->price, 2, '.', ',')  }}</h3>
                <div class="ml-auto">
                    <a type="button" href="" type="button" class="text-center w-40 py-2 px-3 bg-gradient-to-r from-green-400 to-green-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-green-700 hover:to-green-400 transition duration-300 ">
                        Buy Now
                    </a>
                </div>
            </div>
        </div>
        <!-- Course Details Ends -->

    </div>
    <!-- Course Basic Info Ends -->

    <div class="mx-10 mt-4 pb-20">
        <hr>

        <h3 class="my-8 text-gray-700 text-3xl font-bold">What Will You Learn?</h3>

        <div class="px-10">
            <ol class="relative border-l border-gray-200">
                <li class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white"></div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400">Chapter 01</time>
                    <h3 class="text-lg font-semibold text-gray-900">Application UI code in Tailwind CSS</h3>
                    
                        <ul class="list-disc ml-12 text-gray-600">
                            <li>Now this is a story all about</li>
                            <li>Now this is a story all</li>
                        </ul>
                    

                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white"></div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">March 2022</time>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Marketing UI design in Figma</h3>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">All of the pages and components are first designed in Figma and we keep a parity between the two versions even as we update the project.</p>
                </li>
            </ol>

        </div>
    </div>
</div>


<!-- Content Ends -->
@endsection