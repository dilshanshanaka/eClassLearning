@extends('layouts.student')

@php

$title = "Review Course";

@endphp

@section('content')
<!-- Content Starts -->

<div class="flex  my-5">
    <div class="basis-1/3 mx-auto">
        <h5 class="text-2xl font-bold text-gray-800 text-center">{{ $course->title }}</h5>
        <div class="image mt-6">
            <img id="profileImage" class="w-full rounded-md mx-auto my-3" src="{{ asset($course->image_path) }}" alt="profile image">
        </div>

        <div class="form-row mt-3">
            <div class="block text-md font-medium text-slate-600 mb-2">Stars</div>
            <select id="stars" class="border border-gray-300 drop-shadow rounded-md w-full h-8 px-3 text-yellow-500 ">
                <option value="5" selected>★★★★★</option>
                <option value="4">★★★★☆</option>
                <option value="3">★★★☆☆</option>
                <option value="2">★★☆☆☆</option>
                <option value="1">★☆☆☆☆</option>
            </select>
        </div>

        <div class="form-row mt-3">
            <span class="block text-md font-medium text-slate-700">Review</span>
            <textarea id="review" rows="4" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300"></textarea>
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
            stars: $("#stars").val(),
            review: $("#review").val()
        };

        $.ajax({
            method: 'POST',
            url: "{{ route('student.createreview') }}",
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
                window.location.replace("{{ route('student.courses') }}");
            }
        });
    });
</script>

<!-- Content Ends -->
@endsection