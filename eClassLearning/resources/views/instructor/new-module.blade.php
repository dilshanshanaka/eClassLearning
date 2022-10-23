@extends('layouts.instructor')

@php

$title = "add new module";

@endphp

@section('content')
<!-- Content Starts -->
<div class="add-new-course md:max-w-3xl mx-auto">
    <h3 class="text-2xl font-semibold text-slate-800">Create A New Module | {{ $course->title }}</h3>

    <form class="my-6" method="post" id="newCourseForm" enctype="multipart/form-data">
        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Module Title</span>
            <input id="title" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
        </div>

        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Description</span>
            <textarea id="description" name="description" rows="4" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300 w-full"></textarea>
        </div>

        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Module Content</span>
            <textarea id="moduleContent" name="moduleContent"></textarea>
        </div>

        <div>
            <button type="button" id="create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5  mb-2 focus:outline-none">
                Create
            </button>
        </div>
    </form>
</div>

@if($module == NULL)
<input type="text" id="moduleNo" name="moduleNo" value="0" hidden>
@else
<input type="text" id="moduleNo" name="moduleNo" value="{{ $module->module_no }}" hidden>
@endif

<input type="text" id="courseId" name="courseId" value="{{ $course->id }}" hidden>


<script type="text/javascript">
    // SummerNote
    $('#moduleContent').summernote({
        placeholder: 'Enter Module Content',
        tabsize: 2,
        height: 500,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'video']],
            ['view', ['codeview']]
        ]
    });


    // Add New Course
    $("#create").click(function(e) {
        e.preventDefault();

        var formData = {
            title: $("#title").val(),
            description: $("#description").val(),
            courseId: $("#courseId").val(),
            moduleNo: $("#moduleNo").val(),
            moduleContent: $('#moduleContent').summernote('code')
        };

        $.ajax({
            method: 'POST',
            url: "{{ route('instructor.course.module.create') }}",
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