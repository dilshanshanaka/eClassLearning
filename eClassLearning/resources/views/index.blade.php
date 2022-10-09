@extends('layouts.home')

@section('content')

<!-- Content Starts -->
<div class="content mt-12">
    <!-- Categories Starts -->
    <h4 class="text-center font-bold text-lg text-violet-800">CATEGORIES</h4>
    <h2 class="text-center font-bold text-4xl text-gray-800 mt-3">Explore Our Course Categories</h2>

    <div class="mt-14 flex justify-between space-x-8 md:max-w-6xl mx-auto">
        <!-- Single Category Starts -->
        <div class="basis-1/2 md:basis-1/6 shadow-lg p-3 rounded-md bg-purple-50">
            <img class="w-96 rounded-md mb-2" src="{{ asset('images/web-dev.jpg') }}" alt="Web Development Laptop Image">
            <a class="text-center text-slate-800 text-md font-semibold" href="#">Web Development</a>
        </div>
        <!-- Single Category Starts -->

        <!-- Single Category Starts -->
        <div class="basis-1/2 md:basis-1/6 shadow-lg p-3 rounded-md">
            <img class="w-96 rounded-md mb-2" src="{{ asset('images/web-dev.jpg') }}" alt="Web Development Laptop Image">
            <a class="text-center text-gray-800 text-md font-semibold" href="#">Business</a>
        </div>
        <!-- Single Category Starts -->

    </div>
    <!-- Categories Ends -->

</div>

<div class=" text-center h-96">

</div>
<!-- Content Ends -->

@endsection