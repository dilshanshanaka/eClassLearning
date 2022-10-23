@extends('layouts.student')

@php

$title = "courses";

@endphp

@section('content')
<!-- Content Starts -->
@foreach($courses as $course)
<div class="single-course rounded shadow-lg">

    <div class="flex space-x-8">
        <div class="basis-1/3 p-6">
            <img src="{{ asset($course->image_path) }}" class="w-[300px] rounded-md" alt="{{ $course->title }}">
        </div>
        <div class="basis-2/3 py-6">
            <h2 class="text-gray-700 text-xl font-bold">{{ $course->title }}</h2>

            <h4>Course Completed : 0%</h4>
            <h4>Progress</h4>
            <hr class="my-3 mr-6">
            <h5>Module One Quiz - 0/10</h5>
            <hr class="mt-3 mr-6">
            <div class="grid gap-6 mb-6 md:grid-cols-4 text-center mt-5">
                <a type="button" href="{{ route('student.course', $course->id) }}" type="button" class="py-2 px-3 bg-gradient-to-r from-green-400 to-green-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-green-700 hover:to-green-400 transition duration-300 w-full">
                    Continue
                </a>
                <a type="button" href="{{ route('student.question', $course->id) }}" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                    Ask A Question
                </a>

                <a type="button" href="{{ route('student.course.review', $course->id) }}" type="button" class="py-2 px-3 bg-gradient-to-r from-yellow-400 to-yellow-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-yellow-700 hover:to-yellow-400 transition duration-300 w-full">
                    Review
                </a>
            </div>
        </div>
    </div>


</div>

@endforeach

<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $courses->links() !!}
</div>
<!-- Content Ends -->
@endsection