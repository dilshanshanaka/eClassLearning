@extends('layouts.student')

@php

$title = "profile";

@endphp

@section('content')
<!-- Content Starts -->

<!-- Profile Update Starts -->
<div class="update-profile">

    <div class="md:flex md:space-x-8 mx-auto">
        <div class="basis-3/12">
            <h3 class="text-lg">Update Profile</h3>
            <p class="text-gray-600">Update you personal details...</p>
        </div>

        <div class="basis-8/12 mb-2">
            <form class="my-6">
                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">First Name</span>
                        <input id="firstName" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full " value="{{ $student->first_name }}">
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">Last Name</span>
                        <input id="lastName" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full " value="{{ $student->last_name }}">
                    </div>
                </div>

                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">Mobile</span>
                        <input id="mobile" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full " value="{{ $student->mobile }}">
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">Highest Qualification</span>
                        <select id="qualification" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full text-slate-600 ">
                            <option value="Primary" @if($student->highest_education == 'Primary') selected @endif>Primary</option>
                            <option value="Secondary" @if($student->highest_education == 'Secondary') selected @endif>Secondary</option>
                            <option value="Ordinary Level" @if($student->highest_education == 'Ordinary Level') selected @endif>Ordinary Level</option>
                            <option value="Advanced Level" @if($student->highest_education == 'Advanced Level') selected @endif>Advanced Level</option>
                            <option value="Certificate" @if($student->highest_education == 'Certificate') selected @endif>Certificate</option>
                            <option value="Diploma" @if($student->highest_education == 'Diploma') selected @endif>Diploma</option>
                            <option value="Degree" @if($student->highest_education == 'Degree') selected @endif>Degree</option>
                        </select>
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">Date of Birth</span>
                        <input id="dateOfBirth" type="date" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" value="{{ $student->date_of_birth }}">
                    </div>
                </div>
                <button type="button" id="studentUpdate" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center">Update</button>
            </form>
        </div>
    </div>

    <hr>

    <div class="md:flex md:space-x-8 mx-auto mt-8">
        <div class="basis-3/12">
            <h3 class="text-lg">Change Password</h3>
            <p class="text-gray-600">Enter your new password, then click Change Password.</p>
        </div>

        <div class="basis-8/12">
            <span id="change-password"></span>
            <form id="changePasswordForm" class="my-6">
                <div class="mb-6">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Current Password</span>
                    <input id="currentPassword" type="password" class="border border-gray-300 drop-shadow rounded-md block p-2 md:w-1/2">
                </div>
                <div class="mb-6">
                    <span class="block text-sm font-medium text-slate-700 mb-2">New Password</span>
                    <input id="newPassword" type="password" class="border border-gray-300 drop-shadow rounded-md block p-2 md:w-1/2">
                </div>

                <div class="mb-6">
                    <span class="block text-sm font-medium text-slate-700 mb-2">Confirm Password</span>
                    <input id="confirmPassword" type="password" class="border border-gray-300 drop-shadow rounded-md block p-2 md:w-1/2">
                </div>

                <button type="button" id="changePassword" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center">Change Password</button>
            </form>
        </div>
    </div>
</div>
<!-- Profile Update Ends -->

<script type="text/javascript">
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    // Student Update
    $("#studentUpdate").click(function(e) {
        e.preventDefault();

        var formData = {
            firstName: $("#firstName").val(),
            lastName: $("#lastName").val(),
            mobile: $("#mobile").val(),
            dateOfBirth: $("#dateOfBirth").val(),
            qualification: $("#qualification").val(),
        };

        $.ajax({
            method: 'PUT',
            url: "{{ route('student.update') }}",
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
                location.reload();
            }
        });
    });


    // Student Change Password
    $("#changePassword").click(function(e) {
        // Remove Error Message
        $("span").remove(".confirm-password-error");
        $("span").remove(".credential-error");

        e.preventDefault();

        // Data From Inputs
        var currentPassword = $("#currentPassword").val();
        var newPassword = $("#newPassword").val();
        var confirmPassword = $("#confirmPassword").val();

        if (newPassword == confirmPassword && newPassword != "") {
            // Form Data
            var formData = {
                currentPassword: currentPassword,
                newPassword: newPassword
            };

            $.ajax({
                method: 'PUT',
                url: "{{ route('auth.changePassword') }}",
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
                    // Check Current Password is valid
                } else if (data.credentials == "password") {
                    $(`#currentPassword`).after(`<span class="credential-error mt-2 text-sm text-red-600 dark:text-red-500">Incorrect Password</span>`);
                } else {
                    // Display Success Message
                    $(`#change-password`).after(`
                    <div class="success-message md:w-1/2 p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                        Password Changed!
                    </div>
                    `);

                    // Fade Success Message
                    $('.success-message').fadeOut(6000);

                }
            });


        } else {
            $('#confirmPassword').after('<span class="confirm-password-error mt-2 text-sm text-red-600 dark:text-red-500">Confirm password mismatch.</span>');
        }

    });
</script>

<!-- Content Ends -->
@endsection