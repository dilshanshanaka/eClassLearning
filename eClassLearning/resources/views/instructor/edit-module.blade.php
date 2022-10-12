@extends('layouts.instructor')

@php

$title = "edit module";

@endphp

@section('content')
<!-- Content Starts -->
<div class="add-new-course md:max-w-3xl mx-auto">
    <h3 class="text-2xl font-semibold text-slate-800">Edit Module | {{ $module->title }}</h3>

    <form class="my-6" method="post" id="newCourseForm" enctype="multipart/form-data">
        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Module Title</span>
            <input id="title" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" value="{{ $module->title }}">
        </div>

        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Description</span>
            <textarea id="description" name="description" rows="4" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300 w-full">{{ $module->description }}</textarea>
        </div>

        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Module Content</span>
            <textarea id="moduleContent" name="moduleContent"></textarea>
        </div>

        <div>
            <button type="button" id="update" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5  mb-2 focus:outline-none">
                Update
            </button>
        </div>
    </form>
</div>

<input type="text" id="contentData" name="contentData" value="{{ $module->data }}" hidden>
<input type="text" id="moduleId" name="moduleId" value="{{ $module->id }}" hidden>


<script type="text/javascript">

    var contentData = $("#contentData").val();
    $('#moduleContent').summernote('code', contentData);

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
    $("#update").click(function(e) {
        e.preventDefault();

        var formData = {
            title: $("#title").val(),
            description: $("#description").val(),
            moduleId: $("#moduleId").val(),
            moduleContent: $('#moduleContent').summernote('code')
        };

        $.ajax({
            method: 'PUT',
            url: "{{ route('instructor.course.module.update') }}",
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
                window.location.replace("{{ route('instructor.course', $courseId) }}");
            }
        });
    });
</script>

<!-- Content Ends -->
@endsection