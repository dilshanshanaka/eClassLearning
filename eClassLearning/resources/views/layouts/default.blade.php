<!doctype html>

<html>
@include('includes.head')

<body>

    <div class="bg-gradient-to-bl from-sky-100 via-pink-100 to-purple-100 backdrop-blur-md pb-3 shadow-md">
        @include('includes.header')
    </div>

    <div class="content">
        @yield('content')
    </div>

    @include('includes.footer')

</body>

</html>