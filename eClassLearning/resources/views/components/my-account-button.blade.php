@php
    $dashboardRoute = $role.".dashboard";
@endphp 

<a href="{{ route($dashboardRoute) }}">
    <button class="py-2 px-3 bg-gradient-to-r from-sky-500 to-blue-700 text-white rounded-md 
                        shadow text-sm font-semibold bg hover:from-blue-700 hover:to-sky-500 transition duration-300">
        My Account
    </button>
</a>