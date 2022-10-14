@php
$basePage = null;
$page = "change password";
@endphp

@extends('layouts.course-verifier')

@section('content')

<form id="changePasswordForm" class="my-8">
    <div class="mb-6">
        <span class="block text-sm font-medium text-slate-700 mb-2">Current Password</span>
        <input id="currentPassword" type="password" class="border border-gray-300 drop-shadow rounded-md block p-2 md:w-1/3">
    </div>
    <div class="mb-6">
        <span class="block text-sm font-medium text-slate-700 mb-2">New Password</span>
        <input id="newPassword" type="password" class="border border-gray-300 drop-shadow rounded-md block p-2 md:w-1/3">
    </div>

    <div class="mb-6">
        <span class="block text-sm font-medium text-slate-700 mb-2">Confirm Password</span>
        <input id="confirmPassword" type="password" class="border border-gray-300 drop-shadow rounded-md block p-2 md:w-1/3">
    </div>

    <button type="button" id="changePassword" class="text-white bg-blue-700 hover:bg-blue-800 font-medium rounded-lg text-sm sm:w-auto px-5 py-2.5 text-center">Change Password</button>
</form>


<script>
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

@endsection