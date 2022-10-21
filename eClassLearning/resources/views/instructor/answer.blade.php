@extends('layouts.instructor')

@php

$title = "Answer Question";

@endphp

@section('content')
<!-- Content Starts -->

<div class="flex  my-5">
    <div class="basis-1/2 mx-auto">
        <h5 class="text-2xl font-bold text-gray-800 text-center">{{ $question->title }}</h5>
        <div class="image mt-6">
            @php
            $imagePath = "images/blank-profile-picture.png";

            if ($student->profile_image_path != NULL){
            $imagePath = $student->profile_image_path;
            }
            @endphp

            <img id="profileImage" class="w-[150px] h-[150px] rounded-full mx-auto my-3" src="{{ asset($imagePath) }}" alt="profile image">

        </div>
        <h5 class="text-xl font-bold text-gray-700 text-center mt-2">{{ $student->first_name. ' '.$student->last_name }}</h5>

        <h5 class="mt-3 text-md font-semibold text-gray-900">{{ $question->question }}</h5>

        <div class="form-row mt-3">
            <span class="block text-md font-medium text-slate-700">Answer</span>
            <textarea id="answer" rows="4" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300"></textarea>
        </div>

        <button id="update" type="button" class="mt-4 py-2 px-4 bg-gradient-to-r from-sky-400 to-blue-600 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300">
            Submit
        </button>
    </div>
</div>

<input type="text" id="questionId" value="{{ $question->id }}" hidden>


<script>
    $("#update").click(function(e) {
        e.preventDefault();

        var formData = {
            questionId: $("#questionId").val(),
            answer: $("#answer").val(),
        };

        $.ajax({
            method: 'PATCH',
            url: "{{ route('instructor.updatequestion') }}",
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
                window.location.replace("{{ route('instructor.questions') }}");
            }
        });
    });
</script>


<!-- Content Ends -->
@endsection