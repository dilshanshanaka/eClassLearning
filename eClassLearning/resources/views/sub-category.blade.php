@extends('layouts.default')

@section('content')

<div class="py-20 bg-gray-100 text-center">
    <h1 class="text-4xl uppercase text-gray-700 font-bold ">{{ $category->sub_category }}</h1>

    <!-- Breadcrumb Starts -->
    <nav class="flex pt-2 justify-center" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li class="inline-flex items-center">
                <span class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                    <i class="fa-solid fa-house-user"></i>&emsp;Home
                </span>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 capitalize">Courses</span>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 capitalize">{{ $category->main_category }}</span>
                </div>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 capitalize">{{ $category->sub_category }}</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- Breadcrumb Ends -->
</div>

<div class="px-10">

    <div class="">

    </div>




    <div class="flex space-x-6 py-10">

        <div class="basis-1/4">
            <div class="p-8 shadow-xl h-96 rounded-lg">
                <h4 class="uppercase text-gray-700 font-bold text-lg">Filter By</h4>
                <div class="main-categories mt-3">
                    <h4 class="text-gray-700 font-semibold text-md">Main Categories</h4>

                    <ul class="pl-3">
                        @foreach($mainCategories as $mainCategory)
                        <li><a href="{{ route('courses.maincategory', $mainCategory->id) }}">{{ $mainCategory->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
                <div class="main-categories mt-3">
                    <h4 class="text-gray-700 font-semibold text-md">Sub Categories</h4>

                    <ul class="pl-3">
                        @foreach($subCategories as $subCategory)
                        <li><a href="{{ route('courses.subcategory', ['mainCategoryId'=> $subCategory->main_category_id, 'subCategoryId'=> $subCategory->id]) }}">{{ $subCategory->title }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="basis-full">
            <div class="courses">
                <div class="grid gap-6 my-2 md:grid-cols-4">
                    @foreach($courses as $course)
                    <!-- Single Course Starts -->
                    <div class="w-full max-w-sm bg-white rounded-xl shadow-lg">
                        <a href="#">
                            <img class="rounded-t-lg h-36 w-full" src="{{ asset($course->image_path) }}" alt="course image">
                        </a>
                        <div class="px-3 py-4">
                            <a href="#">
                                <h5 class="text-md font-bold tracking-tight text-gray-900">{{ $course->title }}</h5>
                            </a>

                            <h6 class="text-sm text-gray-500 text-center mt-2">{{ $course->main_category }} <br> {{ $course->sub_category }}</h6>


                            <div class="flex items-center justify-center text-yellow-600 mt-2">

                                @php $stars = round($course->stars); @endphp

                                @for($i=0; $i < 5; $i++) @php if($stars> 0){

                                    @endphp
                                    <i class="fa-solid fa-star"></i>
                                    @php $stars--;
                                    }else{
                                    @endphp

                                    <i class="fa-regular fa-star"></i>
                                    @php } @endphp
                                    @endfor

                            </div>
                            <h3 class="text-lg font-bold text-gray-900 text-center mt-2">LKR {{ number_format($course->price, 2, ',', '.')  }}</h3>


                            <div class="grid gap-6 md:grid-cols-2">
                                <h6 class="text-sm text-gray-700 mt-2">Status:</h6>

                                @if($course->isVerified == true)
                                <h6 class="text-sm text-right text-green-700 mt-2"><i class="fa-regular fa-circle-check"></i> Verified</h6>
                                @else
                                <h6 class="text-sm text-right text-gray-700 mt-2">Not Verified</h6>
                                @endif
                            </div>

                            <div class="flex items-center mt-3">
                                <a href="/course/{{ $course->id }}" type="button" class="text-center py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Single Course Ends -->
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center pt-14 pb-4 px-4 basis-full">
                {!! $courses->links() !!}
            </div>
        </div>

    </div>

</div>

@endsection