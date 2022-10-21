@extends('layouts.default')

@section('content')
<!-- Content Starts -->

<div class="content md:max-w-6xl shadow-2xl rounded-xl bg-white mx-auto my-12">
    <!-- Course Basic Info Start -->
    <div class="flex">
        <!-- Course Image Starts -->
        <div class="basis-1/2 p-10">
            <img class="w-full h-72 rounded-lg" src="{{ asset($course->image_path) }}" alt="course image">
        </div>
        <!-- Course Image Ends -->

        <!-- Course Details Starts -->
        <div class="basis-1/2 pt-10 md:pr-10">
            <h2 class="text-gray-800 text-4xl font-bold">{{ $course->title }}</h2>
            <h6 class="text-md text-gray-500 mt-3">{{ $course->mainCategory->title }} > {{ $course->subCategory->title }}</h6>
            @if($course->isVerified == true)
            <h3 class="text-md text-green-600 mt-2 font-semibold"><i class="fa-regular fa-circle-check"></i> eClassLearning Verified</h3>
            @endif
            <p class="mt-2 text-justify text-gray-700">{{ $course->description }}</p>

            <div class="stars my-3">
                <h3 class="text-yellow-500 text-md">
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-solid fa-star"></i>
                    <i class="fa-regular fa-star-half-stroke"></i>
                    <i class="fa-regular fa-star"></i>
                </h3>
            </div>

            <h6 class="text-md text-gray-600 mt-3">Duration : {{ $course->estimated_total_time }} hours </h6>


            <div class="my-3 grid gap-6 md:grid-cols-2">
                <h3 class="text-2xl font-bold text-gray-800 text-left">LKR {{ number_format($course->price, 2, '.', ',')  }}</h3>
                <div class="ml-auto">
                    <button type="button" href="" type="button" class=" enroll text-center w-40 py-2 px-3 bg-gradient-to-r from-green-400 to-green-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-green-700 hover:to-green-400 transition duration-300 ">
                        Buy Now
                    </button>
                </div>

            </div>
        </div>
        <!-- Course Details Ends -->

    </div>
    <!-- Course Basic Info Ends -->

    <div class="mx-10 mt-4 pb-20">
        <hr>

        <h3 class="my-8 text-gray-700 text-3xl font-bold">What Will You Learn?</h3>

        <div class="px-10">
            <ol class="relative border-l border-gray-200">
                <li class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white"></div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400">Chapter 01</time>
                    <h3 class="text-lg font-semibold text-gray-900">Application UI code in Tailwind CSS</h3>

                    <ul class="list-disc ml-12 text-gray-600">
                        <li>Now this is a story all about</li>
                        <li>Now this is a story all</li>
                    </ul>


                </li>
                <li class="mb-10 ml-4">
                    <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -left-1.5 border border-white"></div>
                    <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">March 2022</time>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Marketing UI design in Figma</h3>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">All of the pages and components are first designed in Figma and we keep a parity between the two versions even as we update the project.</p>
                </li>
            </ol>

        </div>
    </div>
</div>


<!-- Main modal -->
<div id="paymentModal" tabindex="-1" aria-hidden="true" class="enroll-modal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
    <div class="relative p-4 w-full max-w-2xl h-full md:h-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex justify-between items-start p-4 rounded-t border-b">
                <h3 class="text-xl font-semibold text-gray-900">
                    VISA / MASTER Card Payment
                </h3>
                <button type="button" class="close text-gray-400 bg-red-300 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="defaultModal">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <h4 class="text-slate-700 text-lg" id="amount">Amount : <span class="text-lg font-semibold text-gray-700">LKR {{ number_format($course->price, 2, '.', ',')  }}</span></h4>

                <div class="grid gap-6 mb-6 md:grid-cols-2">
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">Card Holder Name</span>
                        <input id="cardHolderName" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" placeholder="John Doe">
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">Card Number</span>
                        <input id="cardNumber" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full " placeholder="1111 1111 1111 1111">
                    </div>
                </div>
                <div class="grid gap-6 mb-6 md:grid-cols-3">
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">Expiry</span>
                        <input id="expiry" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" placeholder="12/22">
                    </div>
                    <div>
                        <span class="block text-sm font-medium text-slate-700 mb-2">CVV/ CVC</span>
                        <input id="cvv" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full " placeholder="000">
                    </div>
                </div>
            </div>
            <!-- Modal footer -->
            <div class="flex items-center p-6 space-x-2 rounded-b border-t border-gray-200">
                <button data-modal-toggle="defaultModal" id="pay" type="button" class="pay text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Pay Now</button>
                <button data-modal-toggle="defaultModal" type="button" class="cancel text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700">Cancel</button>
            </div>
        </div>
    </div>
</div>

<input type="text" id="coursePrice" value="{{ $course->price }}" hidden>
<input type="text" id="courseId" value="{{ $course->id }}" hidden>
<input type="text" id="courseTitle" value="{{ $course->title }}" hidden>

<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    const enrollButton = document.querySelector("button.enroll");
    const closeButton = document.querySelector("button.close");
    const cancelButton = document.querySelector("button.cancel");
    const enrollModal = document.querySelector(".enroll-modal");

    enrollButton.addEventListener("click", () => {
        enrollModal.classList.toggle("hidden");
    });

    closeButton.addEventListener("click", () => {
        enrollModal.classList.add("hidden");
    });

    cancelButton.addEventListener("click", () => {
        enrollModal.classList.add("hidden");
    });


    $("#pay").click(function(e) {
        e.preventDefault();
        $("span").remove(".error"); // Remove Error Messages


        // Data From Inputs
        var cardHolderName = $("#cardHolderName").val();
        var cardNumber = $("#cardNumber").val();
        var expiry = $("#expiry").val();
        var cvv = $("#cvv").val();

        // Test purpose only
        if (cardHolderName == "" || cardNumber == "" || expiry == "" || cvv == "") {
            $('#amount').after('<span class="error mt-2 text-sm text-red-600 dark:text-red-500">All fields required.</span>');
        } else {
            var formData = {
                amount: $("#coursePrice").val(),
                courseId: $("#courseId").val(),
                courseTitle: $("#courseTitle").val(),
            };

            $.ajax({
                method: 'POST',
                url: "{{ route('student.enroll') }}",
                headers: {
                    'X-CSRF-TOKEN': _token
                },
                data: formData,
            }).done(function(data) {
                if (data.success == "Sucessfully Added") {
                    window.location.replace("{{ route('student.profile') }}");
                }
            });
        }

    });


    $.ajax({
        method: 'GET',
        url: "http://127.0.0.1:5000/predict/The%20Analytics%20Edge",
        headers: {
            'X-CSRF-TOKEN': _token
        },
    }).done(function(data) {
        console.log(data);
        console.log(data.data);
        console.log("working");
    });
</script>

<!-- Content Ends -->
@endsection