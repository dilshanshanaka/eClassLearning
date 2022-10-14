@php
$basePage = "users";
$page = "course verifiers";
@endphp

@extends('layouts.admin')

@section('content')

<div class="flex justify-between">
    <h5 class="text-gray-700 text-xl font-bold">Edit Course Verifier</h5>
    <!-- <a href="#" class="font-medium text-white px-2 py-1 rounded-md hover:bg-blue-700 bg-blue-500">Add New</a> -->
</div>

<div class="form">
    <form action="">
        <div class="flex space-x-6 mt-4">
            <div class="form-row mt-3 basis-1/2 md:basis-1/3 ">
                <span class="block text-md font-medium text-slate-700">First Name</span>
                <input id="firstName" value="{{ $courseVerifier->first_name }}" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>

            <div class="basis-1/2 md:basis-1/3 form-row mt-3">
                <span class="block text-md font-medium text-slate-700">Last Name</span>
                <input id="lastName" value="{{ $courseVerifier->last_name }}" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>
        </div>
        <div class="flex space-x-6 mt-3">
            <div class="form-row mt-3 basis-1/2 md:basis-1/3 ">
                <span class="block text-md font-medium text-slate-700">Email</span>
                <input id="email" value="{{ $userEmail->email }}" disabled type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>

            <div class="basis-1/2 md:basis-1/3 form-row mt-3">
                <span class="block text-md font-medium text-slate-700">Mobile</span>
                <input id="mobile" value="{{ $courseVerifier->mobile }}" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>
        </div>

        <div class="flex space-x-6 mt-3">
            <div class="form-row mt-3 basis-1/2 md:basis-1/3">
                <div class="block text-md font-medium text-slate-600 mb-2">Highest Academic Qualification</div>
                <select id="qualification" class="border border-gray-300 drop-shadow rounded-md w-full h-8 px-3 text-slate-600 ">
                    
                    <option  value="Advanced Level" @if($courseVerifier->highest_education == 'Advanced Level') selected @endif>Advanced Level</option>
                    <option value="Certificate" @if($courseVerifier->highest_education == 'Certificate') selected @endif>Certificate</option>
                    <option value="Diploma" @if($courseVerifier->highest_education == 'Diploma') selected @endif>Diploma</option>
                    <option value="Degree" @if($courseVerifier->highest_education == 'Degree') selected @endif>Degree</option>
                </select>
            </div>
        </div>


        <button type="button" id="update" class="mt-5 font-medium text-white px-4 py-2 w-28 rounded-md hover:bg-blue-700 bg-blue-500">
            Update
        </button>

    </form>

</div>

<input type="text" id="courseVerifierId" value="{{ $courseVerifier->id }}" hidden>


<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    // Course Verifier Register
    $("#update").click(function(e) {

        e.preventDefault();

        var formData = {
            id: $("#courseVerifierId").val(),
            firstName: $("#firstName").val(),
            lastName: $("#lastName").val(),
            mobile: $("#mobile").val(),
            qualification: $("#qualification").val(),
        };

        console.log(formData);

        $.ajax({
            method: 'PATCH',
            url: "{{ route('admin.user.course-verifier.update') }}",
            headers: {
                'X-CSRF-TOKEN': _token
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
                if (data.success == "success") {
                    window.location.href = "{{ route('admin.users.course-verifiers') }}";
                }
            }
        });
    });
</script>

@endsection