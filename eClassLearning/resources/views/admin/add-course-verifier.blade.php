@php
$basePage = "users";
$page = "course verifiers";
@endphp

@extends('layouts.admin')

@section('content')

<div class="flex justify-between">
    <h5 class="text-gray-700 text-xl font-bold">Add New Course Verifier</h5>
    <!-- <a href="#" class="font-medium text-white px-2 py-1 rounded-md hover:bg-blue-700 bg-blue-500">Add New</a> -->
</div>

<div class="form">
    <form action="">
        <div class="flex space-x-6 mt-4">
            <div class="form-row mt-3 basis-1/2 md:basis-1/3 ">
                <span class="block text-md font-medium text-slate-700">First Name</span>
                <input id="firstName" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>

            <div class="basis-1/2 md:basis-1/3 form-row mt-3">
                <span class="block text-md font-medium text-slate-700">Last Name</span>
                <input id="lastName" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>
        </div>
        <div class="flex space-x-6 mt-3">
            <div class="form-row mt-3 basis-1/2 md:basis-1/3 ">
                <span class="block text-md font-medium text-slate-700">Email</span>
                <input id="email" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>

            <div class="basis-1/2 md:basis-1/3 form-row mt-3">
                <span class="block text-md font-medium text-slate-700">Mobile</span>
                <input id="mobile" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>
        </div>

        <div class="flex space-x-6 mt-3">
            <div class="form-row mt-3 basis-1/2 md:basis-1/3">
                <div class="block text-md font-medium text-slate-600 mb-2">Highest Academic Qualification</div>
                <select id="qualification" class="border border-gray-300 drop-shadow rounded-md w-full h-8 px-3 text-slate-600 ">
                    <option value="Advanced Level">Advanced Level</option>
                    <option value="Certificate">Certificate</option>
                    <option value="Diploma">Diploma</option>
                    <option value="Degree">Degree</option>
                </select>
            </div>
        </div>

        <div class="flex space-x-6 mt-3">
            <div class="form-row mt-3 basis-1/2 md:basis-1/3 ">
                <span class="block text-md font-medium text-slate-700">Password</span>
                <input id="password" type="password" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>

            <div class="basis-1/2 md:basis-1/3 form-row mt-3">
                <span class="block text-md font-medium text-slate-700">Confirm Password</span>
                <input id="confirmPassword" type="password" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            </div>
        </div>

        <button type="button" id="create" class="mt-4 font-medium text-white px-4 py-2 w-28 rounded-md hover:bg-blue-700 bg-blue-500">
            Create
        </button>

    </form>

</div>


<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    // Course Verifier Register
    $("#create").click(function(e) {
        $("span").remove(".confirm-password-error"); // Remove Password Mismatch Error Message

        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();

        // Check If Password And Confirm Password Matches
        if (password == confirmPassword && password != "") {
            e.preventDefault();

            var formData = {
                role: "course verifier",
                firstName: $("#firstName").val(),
                lastName: $("#lastName").val(),
                email: $("#email").val(),
                password: $("#password").val(),
                mobile: $("#mobile").val(),
                qualification: $("#qualification").val(),
            };

            console.log(formData);

            $.ajax({
                method: 'POST',
                url: "{{ route('admin.user.course-verifier.create') }}",
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
        } else {
            $('#confirmPassword').after('<span class="confirm-password-error mt-2 text-sm text-red-600 dark:text-red-500">Password mismatch.</span>');

        }

    });
</script>

@endsection