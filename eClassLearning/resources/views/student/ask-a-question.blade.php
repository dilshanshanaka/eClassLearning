@extends('layouts.student')

@php

$title = "questions";

@endphp

@section('content')
<!-- Content Starts -->

<div class="flex  my-5">
    <div class="basis-1/2 mx-auto">
        <h5 class="text-2xl font-bold text-gray-800 text-center">{{ $course->title }}</h5>
        <div class="image mt-6">
            @php
            $imagePath = "images/blank-profile-picture.png";

            if ($course->profile_image_path != NULL){
            $imagePath = $course->profile_image_path;
            }
            @endphp

            <img id="profileImage" class="w-[150px] h-[150px] rounded-full mx-auto my-3" src="{{ asset($imagePath) }}" alt="profile image">

        </div>
        <h5 class="text-xl font-bold text-gray-700 text-center mt-2">{{ $course->first_name. ' '.$course->last_name }}</h5>

        <div class="form-row mt-3">
            <span class="block text-md font-medium text-slate-700">Question</span>
            <textarea id="question" rows="4" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300"></textarea>
        </div>

        <button id="create" type="button" class="mt-4 py-2 px-4 bg-gradient-to-r from-sky-400 to-blue-600 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300">
            Submit
        </button>
    </div>
</div>

<input type="text" id="courseId" value="{{ $course->id }}" hidden>

<script>
    $("#create").click(function(e) {
        e.preventDefault();

        var formData = {
            courseId: $("#courseId").val(),
            question: $("#question").val(),
        };

        $.ajax({
            method: 'POST',
            url: "{{ route('student.createquestion') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
        }).done(function(data) {
            $("span").remove(".validation-error"); // Remove Error Messages

            // Check For Errors
            if (data.error != undefined) {
                // Error Message
                $.each(data.error, function(key, value) {
                    $(`#` + key).after(`<span class="validation-error mt-2 text-sm text-red-600 dark:text-red-500">` + value + `</span>`);
                });
            } else {
                console.log(data.success);
                // Redirect to Courses Page
                window.location.replace("{{ route('student.questions') }}");
            }
        });
    });
</script>

<!-- Content Ends -->
@endsection