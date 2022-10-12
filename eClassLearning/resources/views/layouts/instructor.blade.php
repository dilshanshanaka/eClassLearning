<!DOCTYPE html>
<html lang="en">
    
@include('includes.head')

<body>

    <div class="bg-gradient-to-bl from-sky-100 via-pink-100 to-purple-100 backdrop-blur-md pb-3 shadow-md">
        @include('includes.header')
    </div>

    <div class="content py-8 md:px-10 px-4 bg-slate-100">
        <h2 class="font-semibold text-2xl uppercase">{{ $title }}</h2>

        <!-- Breadcrumb Starts -->
        <nav class="flex pt-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <span class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <i class="fa-solid fa-house-user"></i>&emsp;Instructor
                    </span>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 capitalize">{{ $title }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb Ends -->

        <div class="py-8 md:flex md:space-x-8">
            <!-- Side Nav Bar Starts -->
            <div class="md:basis-1/6 shadow-xl bg-white p-3 rounded-lg max-h-fit">
                @php
                $imagePath = "images/blank-profile-picture.png";

                if ($instructor->profile_image_path != NULL){
                $imagePath = $instructor->profile_image_path;
                }
                @endphp
                <!-- Profile Image Starts -->
                <div class="relative">
                    <img id="profileImage" class="w-[100px] h-[100px] rounded-full mx-auto my-3" src="{{ asset($imagePath) }}" alt="profile image">
                    <span class="bottom-0 right-28 md:right-11 absolute">
                        <button type="button" id="profileImageUploadButton" class="py-1 px-2 text-xs text-center text-white bg-blue-700 rounded-full hover:bg-blue-800">
                            <i class="fa-solid fa-camera"></i>
                        </button>
                        <form method="post" id="imageUpload" enctype="multipart/form-data">
                            <input type="file" name="profileImageInput" id="profileImageInput" accept="image/png, image/jpeg" hidden />
                        </form>
                    </span>
                </div>
                <!-- Profile Image Ends -->


                <h4 class="text-center text-lg font-semibold text-gray-900">{{ $instructor->first_name }} {{ $instructor->last_name }}</h4>
                <h4 class="text-center text-gray-600">{{ $email }}</h4>
                <hr class="my-2 mx-auto h-1 bg-gray-300 rounded border-0">
                <ul class="py-1 text-sm text-gray-800" aria-labelledby="sideMenu">
                    <li>
                        <a href="{{ route('instructor.dashboard') }}" class="block py-2 px-2 rounded hover:bg-blue-100 my-1 @if($title === 'dashboard') bg-sky-100 @endif"><i class="fa-solid fa-table-columns"></i>&emsp;Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('instructor.profile') }}" class="block py-2 px-2 rounded hover:bg-blue-100 my-1 @if($title === 'profile') bg-sky-100 @endif"><i class="fa-regular fa-user"></i>&emsp;Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('instructor.courses') }}" class="block py-2 px-2 rounded hover:bg-blue-100 my-1 @if($title === 'courses') bg-sky-100 @endif"><i class="fa-solid fa-graduation-cap"></i>&emsp;Courses</a>
                    </li>
                    <li>
                        <a href="{{ route('instructor.newcourse') }}" class="block py-2 md:pl-10 px-2 rounded hover:bg-blue-100 my-1 @if($title === 'add new course') bg-sky-100 @endif"> Add new Course</a>
                    </li>
                </ul>
            </div>
            <!-- Side Nav Bar Ends -->


            <div class="md:basis-5/6 shadow-xl bg-white rounded-lg p-8">
                @yield('content')
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // Open File Upload
        $('#profileImageUploadButton').click(function() {
            $('#profileImageInput').trigger('click');
        });


        $(document).ready(function(e) {
            // On Change 
            $('#profileImageInput').change(function() {
                // Change Profile Image 
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#profileImage').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);

                // Form Data
                var form = document.getElementById('imageUpload');
                var formData = new FormData(form);

                $.ajax({
                    type: 'POST',
                    url: `{{ route('instructor.profileImage') }}`,
                    data: formData,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                    success: (response) => {

                        console.log(response.success);
                    }
                });
            });
        });
    </script>

    @include('includes.footer')
</body>

</html>