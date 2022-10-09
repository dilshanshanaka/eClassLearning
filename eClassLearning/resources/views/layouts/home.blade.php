<!doctype html>

<html>
@include('includes.head')

<body>

    <div class="bg-gradient-to-bl from-sky-100 via-pink-100 to-purple-100 backdrop-blur-md pb-10">
        @include('includes.header')

        <div class="md:max-w-6xl mx-auto md:flex justify-between space-x-4">
            <div class="pt-32 basis-1/2">
                <h2 class="font-extrabold text-5xl text-gray-900 leading-tight">Learn From Home <br> With Experts</h2>
                <p class="mt-4 text-gray-700 tracking-wide">eClassLearning is online course marketplace that offers
                    various
                    premium courses for your skill development.
                    You can learn anywhere anytime with best quility content.</p>

                <form>
                    <div class="flex space-x-4 mt-6">
                        <input type="text" class="basis-1/2 border-slate-200 drop-shadow-lg rounded-md px-3" placeholder="Advanced Level ICT">
                        <button class="py-2 px-3 bg-gradient-to-r from-pink-400 to-indigo-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-indigo-700 hover:to-pink-400 transition duration-300">
                            Search Course
                        </button>
                    </div>

                </form>
            </div>
            <div class="basis-1/2">
                <img class="w-full" src="{{ asset('images/hero-image.png') }}" alt="Side Image">
            </div>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>

    @include('includes.footer')

</body>

</html>