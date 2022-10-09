@extends('layouts.default')

@section('content')

<!-- Content Starts -->
<div class="content py-20 md:flex justify-center">
    <div class="md:basis-1/2 shadow-2xl rounded-md shadow-slate-300">
        <div class="flex mx-auto items-center">
            <!-- Register Side Image Starts -->
            <div class="image basis-1/2">
                <img class="rounded-md" src="{{ asset('images/signup.jpg') }}" alt="Person Stand beside a login screen">
            </div>
            <!-- Register Side Image Ends -->

            <!-- Register Starts -->
            <div class="form basis-1/2 px-8 py-12">
                <h3 class="font-bold text-md text-violet-800">SIGNUP</h3>
                <h2 class="text-2xl font-bold text-slate-800 mt-2">Create your account</h2>

                <!-- Register Form Starts -->
                <form class="my-4">
                    <!-- Register Form Step One Starts -->
                    <div class="register-form-step-one">
                        <div class="form-row flex space-x-2 items-center">
                            <div class="basis-1/4 block text-md font-medium text-slate-700">I am </div>
                            <div class="basis-3/4">
                                <select id="role" class="border border-gray-300 drop-shadow rounded-md w-full h-8 px-3 text-slate-600 ">
                                    <option value="1" selected>a Student</option>
                                    <option value="2">an Instructor</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">First Name</span>
                            <input id="firstName" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="John">
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Last Name</span>
                            <input id="lastName" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="Doe">
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Email</span>
                            <input id="email" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="johndoe@gmail.com">
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Password</span>
                            <input id="password" type="password" required class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="***********">
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Confirm Password</span>
                            <input id="confirmPassword" type="password" required class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="***********">
                        </div>

                        <div class="form-row mt-6">
                            <button id="next" type="button" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                                Next
                            </button>
                        </div>
                    </div>
                    <!-- Register Form Step One Ends -->

                    <!-- Register Form Step Two: Student Starts -->
                    <div class="register-form-student hidden">
                        <!-- Progress Bar Starts -->
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="bg-sky-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 50%"> 50%</div>
                        </div>
                        <!-- Progress Bar Ends -->

                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Mobile</span>
                            <input id="studentMobile" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="+947712345678">
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Date of Birth</span>
                            <input id="dateOfBirth" type="date" class="mt-1 text-slate-600 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="1998012345678">
                        </div>

                        <div class="form-row mt-3">
                            <div class="block text-md font-medium text-slate-600 mb-2">Highest Academic Qualification</div>
                            <select id="qualification" class="border border-gray-300 drop-shadow rounded-md w-full h-8 px-3 text-slate-600 ">
                                <option value="Primary" selected>Primary</option>
                                <option value="Secondary">Secondary</option>
                                <option value="Ordinary Level">Ordinary Level</option>
                                <option value="Advanced Level">Advanced Level</option>
                                <option value="Certificate">Certificate</option>
                                <option value="Diploma">Diploma</option>
                                <option value="Degree">Degree</option>
                            </select>
                        </div>

                        <div class="form-row flex mt-6 space-x-3">

                            <button id="studentBack" type="button" class="py-2 px-3 bg-gradient-to-r from-slate-400 to-slate-600 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                                Back
                            </button>
                            <button id="studentSubmit" type="submit" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                                Submit
                            </button>
                        </div>
                    </div>
                    <!-- Register Form Step Two: Student Ends -->

                    <!-- Register Form Step Two: Instructor Starts -->
                    <div class="register-form-instructor hidden">
                        <!-- Progress Bar Starts -->
                        <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                            <div class="bg-sky-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full" style="width: 50%"> 50%</div>
                        </div>
                        <!-- Progress Bar Ends -->

                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">NIC</span>
                            <input id="nic" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="1998012345678">
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Mobile</span>
                            <input id="instructorMobile" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="+947712345678">
                        </div>
                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">City</span>
                            <input id="city" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3" placeholder="Colombo">
                        </div>

                        <div class="form-row mt-3">
                            <span class="block text-md font-medium text-slate-700">Bio</span>
                            <textarea id="bio" id="message" rows="4" class="mt-1 block p-2.5 w-full text-sm drop-shadow rounded-md border border-gray-300"></textarea>
                        </div>

                        <div class="form-row flex mt-6 space-x-3">
                            <button id="instructorBack" type="button" class="py-2 px-3 bg-gradient-to-r from-slate-400 to-slate-600 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                                Back
                            </button>
                            <button id="instructorSubmit" type="button" class="py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                                Submit
                            </button>
                        </div>
                    </div>
                    <!-- Register Form Step Two: Instructor Ends -->
                </form>
                <!-- Register Form Ends -->

                <div class="login">
                    <h4 class="text-center text-slate-700">Already Registered? <a class="text-violet-800" href="login">Login</a></h4>
                </div>
            </div>
            <!-- Register Ends -->

        </div>
    </div>
</div>
<!-- Content Ends -->


<script type="text/javascript">
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    // Form Next Function
    $("#next").click(function() {
        $("span").remove(".confirm-password-error"); // Remove Password Mismatch Error Message

        // First Form Data 
        var role = $("#role").val();
        var firstName = $("#firstName").val();
        var lastName = $("#lastName").val();
        var email = $("#email").val();
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();

        // Check If Password And Confirm Password Matches
        if (password == confirmPassword && password != "") {

            if (role == 1) { // Student 
                // Add & Remove Hidden Class
                $(".register-form-step-one").addClass("hidden");
                $(".register-form-student").removeClass("hidden");


                // Student Register
                $("#studentSubmit").click(function(e) {
                    e.preventDefault();

                    var formData = {
                        role: "student",
                        firstName: firstName,
                        lastName: lastName,
                        email: email,
                        password: password,
                        studentMobile: $("#studentMobile").val(),
                        dateOfBirth: $("#dateOfBirth").val(),
                        qualification: $("#qualification").val(),
                    };

                    $.ajax({
                        method: 'POST',
                        url: "{{ route('auth.register') }}",
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
                            let role = data.role;

                            if (role == "student") {
                                window.location.href = "{{ route('student.dashboard') }}";
                            } else if (role == "instructor") {
                                window.location.href = "{{ route('instructor.dashboard') }}";
                            }
                        }
                    });

                });

                // Back Button
                $("#studentBack").click(function() {
                    $(".register-form-step-one").removeClass("hidden");
                    $(".register-form-student").addClass("hidden");
                });

            } else if (role == 2) { // Instructor 
                // Add & Remove Hidden Class
                $(".register-form-step-one").addClass("hidden");
                $(".register-form-instructor").removeClass("hidden");


                // Instructor Register
                $("#instructorSubmit").click(function(e) {
                    e.preventDefault();

                    var formData = {
                        role: "instructor",
                        firstName: firstName,
                        lastName: lastName,
                        email: email,
                        password: password,
                        instructorMobile: $("#instructorMobile").val(),
                        nic: $("#nic").val(),
                        city: $("#city").val(),
                        bio: $("#bio").val(),
                    };

                    $.ajax({
                        method: 'POST',
                        url: "{{ route('auth.register') }}",
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
                            let role = data.role;

                            if (role == "student") {
                                window.location.href = "{{ route('student.dashboard') }}";
                            } else if (role == "instructor") {
                                window.location.href = "{{ route('instructor.dashboard') }}";
                            }
                        }
                    });

                });

                // Back Button
                $("#instructorBack").click(function() {
                    $(".register-form-step-one").removeClass("hidden");
                    $(".register-form-instructor").addClass("hidden");
                });
            }
        } else {
            $('#confirmPassword').after('<span class="confirm-password-error mt-2 text-sm text-red-600 dark:text-red-500">Password mismatch.</span>');
        }


    });
</script>

@endsection