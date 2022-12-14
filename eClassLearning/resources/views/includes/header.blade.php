<!-- Nav Bar Starts -->
<nav>
    <div class="max-w-7xl mx-auto flex justify-between">
        <!-- Logo Starts -->
        <div>
            <a href="#">
                <img class="mt-4" src="{{ asset('images/logo.png') }}" alt="Logo">
            </a>
        </div>
        <!-- Logo Ends -->

        <!-- Primary Nav Starts -->
        <div class="hidden md:flex flex items-center space-x-8">
            <a href="/" class="text-grey-600 hover:text-blue-900">Home</a>
            <!-- Course Categories Starts -->
            <div class="course-categories-dropdown">
                <x-course-categories-nav-dropdown :mainCategories="$mainCategories" />
            </div>
            <!-- Course Categories Ends -->

            <a href="about" class="text-grey-600 hover:text-blue-900">About</a>
            <a href="contact" class="text-grey-600 hover:text-blue-900">Contact</a>
        </div>
        <!-- Primary Nav Ends -->

        <!-- Secondary Nav Starts -->
        @guest
        <div class="hidden md:flex flex items-center space-x-8">
            <a href="{{ route('login') }}">
                <button hr class="text-blue-700">Login</button>
            </a>
            <a href="{{ route('register') }}">
                <button class="py-2 px-3 bg-gradient-to-r from-blue-400 to-blue-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-blue-700 hover:to-blue-400 transition duration-300">
                    Signup
                </button>
            </a>
        </div>
        @endguest

        @auth
        <div class="hidden md:flex flex items-center space-x-2">

            <x-my-account-button :role="$role" />

            <a href="{{ route('auth.logout') }}">
                <button class="py-2 px-3 bg-gradient-to-r from-pink-500 to-red-700 text-white rounded-md 
                        shadow text-sm font-semibold bg hover:from-red-700 hover:to-pink-500 transition duration-300">
                    Logout
                </button>
            </a>
        </div>
        @endauth

        <!-- Secondary Nav Ends -->

        <!-- Mobile Button Starts -->
        <div class="md:hidden flex items-center">
            <button class="mobile-menu-button mr-4">
                <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>
        </div>
        <!-- Mobile Button Ends -->
    </div>

    <!-- Mobile Menu Starts -->
    <div class="hidden mobile-menu md:hidden">
        <a href="/" class="block py-2 px-4 text-sm">Home</a>
        <a href="#" class="block py-2 px-4 text-sm">Course</a>
        <a href="about" class="block py-2 px-4 text-sm">About</a>
        <a href="contact" class="block py-2 px-4 text-sm">Contact</a>
        @guest
        <a href="login" class="block py-2 px-4 text-sm">Login</a>
        <a href="register" class="block py-2 px-4 text-sm">Signup</a>
        @endguest

        @auth
        @php
        $dashboardRoute = $role.".dashboard";
        @endphp
        <a href="{{ route($dashboardRoute) }}" class="block py-2 px-4 text-sm">My Account</a>
        <a href="{{ route('auth.logout') }}" class="block py-2 px-4 text-sm">Logout</a>
        @endauth
    </div>
    <!-- Mobile Menu Ends -->

</nav>
<!-- Nav Bar Ends -->

<!-- <script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script> -->