@extends('layouts.instructor')

@php

$title = "add new course";

@endphp

@section('content')
<!-- Content Starts -->
<div class="add-new-course md:max-w-3xl mx-auto">
    <h3 class="text-2xl font-semibold text-slate-800">Create a new course</h3>

    <form class="my-6" method="post" id="newCourseForm" enctype="multipart/form-data">
        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Course Title</span>
            <input id="title" name="title" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2">
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Main Category</span>
                <select id="mainCategory" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full text-slate-600 ">
                    <option selected value="0">Select a Category</option>
                    @foreach ($mainCategories as $mainCategory)
                    <option value="{{ $mainCategory->id }}">{{ $mainCategory->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Sub Category</span>
                <select id="subCategoryId" name="subCategoryId" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full text-slate-600 ">
                    <option selected id="subCategorySelected">Select a Category</option>
                </select>
            </div>
        </div>

        <div class="mb-6">
            <span class="block text-sm font-medium text-slate-700 mb-2">Description</span>
            <textarea id="description" name="description" rows="8" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300 w-full"></textarea>
        </div>

        <div class="grid gap-6 mb-6 md:grid-cols-2 w-3/4">
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Price</span>
                <input id="price" name="price" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full ">
            </div>
            <div>
                <span class="block text-sm font-medium text-slate-700 mb-2">Estimated Time (Hours)</span>
                <input id="hour" name="hour" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full ">
            </div>
        </div>

        <span class="block text-sm font-medium text-slate-700 mb-2">Upload Cover</span>

        <div class="flex justify-center items-center w-full mb-6">
            <label for="coverImage" id="coverImageLabel" class="flex flex-col justify-center items-center pt-5 pb-6 w-full h-64 rounded-lg border-2 border-gray-300 border-dashed cursor-pointer hover:bg-gray-100">
                <div id="previewPlaceholder">
                    <div class="test flex flex-col justify-center items-center ">
                        <svg aria-hidden="true" class="mb-3 w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG OR JPG (MAX. 800x400px)</p>
                    </div>
                </div>
                <input id="coverImage" name="coverImage" type="file" class="hidden" />
            </label>
        </div>

        <div>
            <button type="button" id="create" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-8 py-2.5  mb-2 focus:outline-none">
                Create
            </button>
        </div>
    </form>
</div>

<script type="text/javascript">
    // Get Sub Category Data
    $('#mainCategory').change(function() {
        $("option").remove(".sub-category");
        var mainCategoryId = $("#mainCategory").val();

        $.ajax({
            method: 'GET',
            url: "/sub-categories/" + mainCategoryId,
        }).done(function(data) {
            $.each(data.subCategories, function(key, value) {
                $(`#subCategorySelected`).after(`<option class="sub-category" value="` + value.id + `">` + value.title + `</option>`);
            });
        });
    });

    // Change Profile Image 
    $('#coverImage').change(function() {
        let reader = new FileReader();
        reader.onload = (e) => {
            $("div").remove(".test");
            $("img").remove(".cover-image");

            $(`#previewPlaceholder`).after(`<img id="preview" class="h-full cover-image" accept="image/png, image/jpeg" src="" alt="">`);

            $('#preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(this.files[0]);
    });


    // Add New Course
    $("#create").click(function(e) {
        e.preventDefault();

        var form = document.getElementById('newCourseForm');
        var formData = new FormData(form);

        $.ajax({
            method: 'POST',
            url: "{{ route('instructor.course.create') }}",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            contentType: false,
            processData: false,
        }).done(function(data) {
            $("span").remove(".validation-error"); // Remove Error Messages

            // Check For Errors
            if (data.error != undefined) {
                // Error Message
                $.each(data.error, function(key, value) {
                    $(`#` + key).after(`<span class="validation-error mt-2 text-sm text-red-600 dark:text-red-500">` + value + `</span>`);
                });
            } else {
                // Redirect to Courses Page
                window.location.replace("{{ route('instructor.courses') }}");
            }
        });
    });
</script>

<!-- Content Ends -->
@endsection