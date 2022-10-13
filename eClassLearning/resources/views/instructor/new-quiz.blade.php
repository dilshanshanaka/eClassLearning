@extends('layouts.instructor')

@php

$title = "add new quiz";

@endphp

@section('content')
<!-- Content Starts -->
<div class="add-new-course md:max-w-3xl mx-auto">
    <h3 class="text-2xl font-semibold text-slate-800">Create A New Quiz</h3>



    <form class="my-6" method="post" id="newCourseForm" enctype="multipart/form-data">
        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Course Name</span>
            <input id="title" disabled value="{{ $course->title }}" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            @if($moduleNo != NULL)
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Quiz Type</span>
                <input id="type" disabled value="module" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" value="module">

            </div>
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Module No</span>
                <input id="moduleNo" disabled type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" value="{{ $moduleNo }}">
            </div>
            @else
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Quiz Type</span>
                <input id="type" disabled value="final" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" value="module">
            </div>
            @endif
        </div>

        <hr>


        <div class="questions">
            <!-- Single Question -->
            <div id="singleQuestion" class="single-question my-6">
                <h4 class="block text-xl font-medium text-slate-800 mb-3">Question 1</h4>
                <div class="mb-2">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Question</span>
                    <textarea id="question1" name="description" rows="2" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300 w-full"></textarea>
                </div>
                <div class="mb-2">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Answer One</span>
                    <input id="answerOne1" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
                </div>
                <div class="mb-2">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Answer Two</span>
                    <input id="answerTwo1" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
                </div>
                <div class="mb-2">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Answer Three</span>
                    <input id="answerThree1" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
                </div>
                <div class="mb-2">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Answer Four</span>
                    <input id="answerFour1" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
                </div>
                <div class="mb-2">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Correct Answer</span>
                    <select id="correctAnswer1" class="border border-gray-300 drop-shadow rounded-md block p-2 w-1/3 text-slate-600 ">
                        <option value="1" selected>Answer One</option>
                        <option value="2">Answer Two</option>
                        <option value="3">Answer Three</option>
                        <option value="4">Answer Four</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="flex space-x-4">
            <button type="button" id="addNewQuestion" class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5  mb-2 focus:outline-none">
                Add New Question
            </button>
            <button type="button" id="create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5  mb-2 focus:outline-none">
                Create Quiz
            </button>
        </div>

    </form>
</div>


<input type="text" id="courseId" name="courseId" value="{{ $course->id }}" hidden>


<script type="text/javascript">
    var questions = 1;

    $("#addNewQuestion").click(function(e) {
        e.preventDefault();

        questions++;

        $(`.questions`).append(`
        <div class="single-question my-6">
            <h4 class="block text-xl font-medium text-slate-800 mb-3">Question ` + questions + `</h4>

            <div class="mb-2">
                <span class="block text-sm font-medium text-slate-700 mb-2">Question</span>
                <textarea id="question` + questions + `" name="description" rows="2" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300 w-full"></textarea>
            </div>
            <div class="mb-2">
                <span class="block text-sm font-medium text-slate-700 mb-2">Answer One</span>
                <input id="answerOne` + questions + `" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
            </div>
            <div class="mb-2">
                <span class="block text-sm font-medium text-slate-700 mb-2">Answer Two</span>
                <input id="answerTwo` + questions + `" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
            </div>
            <div class="mb-2">
                <span class="block text-sm font-medium text-slate-700 mb-2">Answer Three</span>
                <input id="answerThree` + questions + `" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
            </div>
            <div class="mb-2">
                <span class="block text-sm font-medium text-slate-700 mb-2">Answer Four</span>
                <input id="answerFour` + questions + `" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
            </div>
            <div class="mb-2">
                <span class="block text-sm font-medium text-slate-700 mb-2">Correct Answer</span>
                <select id="correctAnswer` + questions + `" class="border border-gray-300 drop-shadow rounded-md block p-2 w-1/3 text-slate-600 ">
                    <option value="1" selected>Answer One</option>
                    <option value="2">Answer Two</option>
                    <option value="3">Answer Three</option>
                    <option value="4">Answer Four</option>
                </select>
            </div>

        </div>`);

        return questions;
    });

    // Add New Course
    $("#create").click(function(e) {
        e.preventDefault();

        var j = 0;
        const quizItems = [];

        for (var i = 1; i <= questions; i++) {
            var qa = {
                question: $("#question" + i).val(),
                answerOne: $("#answerOne" + i).val(),
                answerTwo: $("#answerTwo" + i).val(),
                answerThree: $("#answerThree" + i).val(),
                answerFour: $("#answerFour" + i).val(),
                correctAnswer: $("#correctAnswer" + i).val()
            };

            quizItems.push(qa);
        }


        // Form Data
        var formData = {
            type: $("#type").val(),
            courseId: $("#courseId").val(),
            moduleNo: $("#moduleNo").val(),
            quizItems: quizItems
        };


        $.ajax({
            method: 'POST',
            url: "{{ route('instructor.course.quiz.create') }}",
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
                window.location.replace("{{ route('instructor.course', $course->id) }}");
            }
        });
    });
</script>

<!-- Content Ends -->
@endsection