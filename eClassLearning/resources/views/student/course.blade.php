@extends('layouts.student')

@php

$title = "course";

@endphp

@section('content')

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
        <p class="mt-2 text-justify text-gray-700">{{ $course->description }}</p>

        <a type="button" href="{{ route('student.course.module', ['courseId'=>$course->id, 'id'=> $studentOngoingdModule]) }}" class="mt-6 text-center py-2 px-3 bg-gradient-to-r from-sky-500 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-sky-700 hover:to-sky-500">
            Continue
        </a>
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
            </li>
            <!-- Single Course Module Ends -->
            @endforeach
        </ol>

    </div>
</div>

<input type="text" id="courseId" value="{{ $course->id }}" hidden>

<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    var courseId = $("#courseId").val();

    $("#continue").click(function(e) {
        e.preventDefault();

        $.ajax({
            method: 'PATCH',
            url: "{{ route('student.module.complete', 1) }}",
            headers: {
                'X-CSRF-TOKEN': _token
            }
        }).done(function(data) {
            console.log(data.success);
        });
    });



</script>


@endsection