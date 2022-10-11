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
                    <a href="#" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg bg-blue-200 hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-table-columns"></i>&emsp;Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
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
                        <span class="ml-3"><i class="fa-solid fa-money-check"></i>&emsp;Withdrawal Requests</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-users"></i>&emsp;Users</span>
                    </a>
                    <!-- <ul id="dropdown-example" class="py-2 space-y-2">
                        <li>
                            <a href="#" class="flex items-center p-1 pl-14 w-full text-base font-normal text-gray-800 rounded-lg group hover:bg-blue-200">Students</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 pl-14 w-full text-base font-normal text-gray-800 rounded-lg group hover:bg-blue-200">Instructors</a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center p-1 pl-14 w-full text-base font-normal text-gray-800 rounded-lg group hover:bg-blue-200">Course Verifiers</a>
                        </li>
                    </ul> -->
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-base font-normal text-gray-800 rounded-lg hover:bg-blue-200">
                        <span class="ml-3"><i class="fa-solid fa-file-lines"></i>&emsp;Reports</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center p-2 text-base font-normal text-white-800 rounded-lg bg-red-100 hover:bg-red-200">
                        <span class="ml-3"><i class="fa-solid fa-right-from-bracket"></i>&emsp;Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <!-- Side Bar Ends -->

    @yield('content')

</body>

</html>