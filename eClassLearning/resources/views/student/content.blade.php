<!doctype html>

<html>
@include('includes.head')

<body>

    <div class="bg-gradient-to-bl from-sky-100 via-pink-100 to-purple-100 backdrop-blur-md pb-3 shadow-md">
        @include('includes.header')
    </div>

    <div class="content py-8 md:px-10 px-4 bg-slate-100">
        <h2 class="font-semibold text-2xl uppercase">{{ $course->title.''.$finalModule }}</h2>

        <!-- Breadcrumb Starts -->
        <nav class="flex pt-2" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <span class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        <i class="fa-solid fa-house-user"></i>&emsp;Student
                    </span>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2 dark:text-gray-400 capitalize">Course</span>
                    </div>
                </li>
            </ol>
        </nav>
        <!-- Breadcrumb Ends -->

        <div class="py-8 md:flex md:space-x-8">
            <div class="md:basis-1/6 shadow-xl bg-white p-3 rounded-lg max-h-fit">
                <!-- Side Nav Bar Starts -->
                <ul class="py-1 text-sm text-gray-800" aria-labelledby="sideMenu">
                    @foreach($modules as $module)
                    <li>
                        <h4 class="text-gray-900 font-bold">Module {{ $module->module_no }}</h4>
                        <a href="" class="block py-2 px-2 rounded hover:bg-blue-100 my-1 @if($module->module_no == $pageModule->module_no) bg-sky-100  @endif">{{ $module->title }}</a>
                        @if($module->quiz != null)
                        <a href="" class="block py-2 px-2 rounded hover:bg-blue-100 my-1">Module Quiz</a>
                        @endif
                    </li>
                    @endforeach
                    <li>
                        <a href="" class="block text-gray-900 font-bold py-2 px-2 rounded hover:bg-blue-100 my-1">Final Quiz</a>
                    </li>
                </ul>
            </div>
            <!-- Side Nav Bar Ends -->


            <div class="md:basis-5/6 shadow-xl bg-white rounded-lg p-8">
                <h4 class="mb-4 text-lg text-gray-700 font-bold">{{ $pageModule->title }}</h4>
                <!-- content  -->
                @php echo $pageModule->data; @endphp

                <div class="mt-6 flex justify-end">
                    @if($module->quiz != null)
                    <a type="button" href="{{ route('student.course.quiz', ['courseId'=>$course->id, 'id'=> $moduleQuizId]) }}" class="mt-6 text-center py-2 px-5 bg-gradient-to-r from-sky-500 to-sky-700 text-white rounded-md 
                        shadow font-semibold bg hover:from-sky-700 hover:to-sky-500">
                        Next
                    </a>
                    @endif

                </div>
            </div>

        </div>

    </div>

    @include('includes.footer')

</body>

</html>