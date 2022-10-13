<!doctype html>

<html>

@include('includes.head')

<body class="flex">
    <!-- Side Bar Starts -->
    <aside class="w-64" aria-label="Sidebar">
        <div class="overflow-y-auto py-4 px-3 bg-gray-100 h-screen">
            <a href="https://flowbite.com/" class="flex items-center pl-2.5 mb-5">
                <img class="mt-4" src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
            <ul class="space-y-2 mt-6">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg @if($page == 'dashboard') bg-blue-200 @endif  hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-table-columns"></i>&emsp;Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="users-list flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-users"></i>&emsp;Users&emsp;<i class="fa-solid fa-angle-down"></i></span>
                    </a>
                    @php
                    if($page == 'users' || $page == 'students' || $page == 'instructors'){
                    $listHiddenClass = '';
                    }else{
                    $listHiddenClass = 'hidden';
                    }
                    @endphp
                    <ul id="dropdownList" class="dropdown-user-list {{ $listHiddenClass }} py-2 space-y-2">
                        <li>
                            <a href="{{ route('admin.users') }}" class="flex items-center p-1 pl-14 w-full text-base font-normal text-gray-800 rounded-lg group hover:bg-blue-200 @if($page == 'users') bg-blue-200 @endif">All Users</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.students') }}" class="flex items-center p-1 pl-14 w-full text-base font-normal text-gray-800 rounded-lg group hover:bg-blue-200 @if($page == 'students') bg-blue-200 @endif">Students</a>
                        </li>
                        <li>
                            <a href="{{ route('admin.users.instructors') }}" class="flex items-center p-1 pl-14 w-full text-base font-normal text-gray-800 rounded-lg group hover:bg-blue-200 @if($page == 'instructors') bg-blue-200 @endif">Instructors</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 pl-14 w-full text-base font-normal text-gray-800 rounded-lg group hover:bg-blue-200">Course Verifiers</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ route('admin.courses') }}" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-graduation-cap"></i>&emsp;Courses</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-table-list"></i>&emsp;Appointments</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-file-invoice"></i>&emsp;Purchases</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-money-check"></i>&emsp;Withdrawals</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('auth.logout') }}" class="flex items-center p-2 text-base font-normal text-white-800 rounded-lg bg-red-100 hover:bg-red-200">
                        <span class="ml-3"><i class="fa-solid fa-right-from-bracket"></i>&emsp;Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- Side Bar Ends -->

    <!-- Content Starts -->
    <div class="content p-10 w-full">
        <h2 class="font-semibold text-gray-800 text-2xl uppercase mb-2">{{ $page }}</h2>

        <!-- Breadcrumb Starts -->
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <span class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900">
                        <i class="fa-solid fa-house-user"></i>&emsp;Admin
                    </span>
                </li>
                @if($basePage != NULL)
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-700 hover:text-gray-900 md:ml-2 capitalize">{{ $basePage }}</span>
                    </div>
                </li>
                @endif
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 capitalize">{{ $page }}</span>
                    </div>
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb Ends -->

        <div class="mt-4">
            @yield('content')

        </div>

    </div>
    <!-- Content Ends -->

    <script>
        const userDropdown = document.querySelector("a.users-list");
        const userDropdownList = document.querySelector(".dropdown-user-list");

        userDropdown.addEventListener("click", () => {
            userDropdownList.classList.toggle("hidden");
        });
    </script>
</body>

</html>