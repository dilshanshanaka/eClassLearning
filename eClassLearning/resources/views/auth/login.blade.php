@extends('layouts.default')

@section('content')

<!-- Content Starts -->
<div class="content py-20 md:flex justify-center">
    <div class="md:basis-1/2 shadow-2xl rounded-md shadow-slate-300">

        <div class="flex mx-auto items-center">
            <!-- Login Side Image Starts -->
            <div class="image basis-1/2 ">
                <img class="rounded-md" src="{{ asset('images/login-side.jpg') }}" alt="Laptop Image">
            </div>
            <!-- Login Side Image Ends -->

            <!-- Login Starts -->
            <div class="form basis-1/2 px-8 py-12">
                <h3 class="font-bold text-md text-violet-800">LOGIN</h3>
                <h2 class="text-4xl font-bold text-slate-800 mt-4">Welcome Back</h2>

                <!-- Login Form Starts -->
                <form class="my-8">
                    <div class="form-row">
                        <span class="block text-md font-medium text-slate-600">Email</span>
                        <input type="text" id="email" class="mt-1 border-slate-200 drop-shadow rounded-md w-full h-10 px-3" placeholder="johndoe@gmail.com">
                    </div>
                    <div class="form-row mt-3">
                        <span class="block text-md font-medium text-slate-600">Password</span>
                        <input type="password" id="password" class="mt-1 border-slate-200 drop-shadow rounded-md w-full h-10 px-3" placeholder="***********">
                    </div>

                    <div class="form-row mt-6">
                        <button id="loginSubmit" type="button" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                            Login
                        </button>
                    </div>
                </form>
                <!-- Login Form Ends -->

                <div class="register">
                    <h4 class="text-center text-slate-700">Don't have an account? <a class="text-violet-800" href="#">Register</a></h4>
                </div>
            </div>
            <!-- Login Ends -->

        </div>
    </div>
</div>
<!-- Content Ends -->

<script type="text/javascript">
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    // Student Register
    $("#loginSubmit").click(function(e) {

        e.preventDefault();

        var formData = {
            email: $("#email").val(),
            password: $("#password").val()
        };

        console.log(formData);

        $.ajax({
            method: 'POST',
            url: "{{ route('auth.login') }}",
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
            } else if (data.credentials) {
                // Credentials Errors
                if(data.credentials == "email"){
                    $(`#email`).after(`<span class="validation-error mt-2 text-sm text-red-600 dark:text-red-500">Couldn't find your eClassLearning Account</span>`);
                }else if(data.credentials == "password"){
                    $(`#password`).after(`<span class="validation-error mt-2 text-sm text-red-600 dark:text-red-500">Incorrect Password</span>`);
                }
            } else {
                let role = data.role;

                if (role == "student") {
                    window.location.href="{{ route('student.dashboard') }}";
                } else if (role == "instructor") {
                    window.location.href="{{ route('instructor.dashboard') }}";
                }else if (role == "admin"){
                    window.location.href="{{ route('admin.dashboard') }}";
                }
            }
        });

    });
</script>


@endsection