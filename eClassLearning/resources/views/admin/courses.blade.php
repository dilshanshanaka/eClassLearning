@php
$basePage = null;
$page = "courses";
@endphp

@extends('layouts.admin')

@section('content')

<div>
    <h5 class="text-gray-700">Total Courses: {{ $totalCourses }}</h5>
    <h5 class="text-gray-700">Total Published Courses: {{ $totalPublishedCourses }}</h5>
</div>

<div class="relative shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 text-center">
            <tr>
                <th scope="col" class="py-3 px-1">
                    Course ID
                </th>
                <th scope="col" class="py-3 px-1  text-left">
                    Title
                </th>
                <th scope="col" class="py-3 px-1">
                    Main Category
                </th>
                <th scope="col" class="py-3 px-1">
                    Sub Category
                </th>
                <th scope="col" class="py-3 px-1">
                    Instructor (ID : Name)
                </th>
                <th scope="col" class="py-3 px-1">
                    Price
                </th>
                <th scope="col" class="py-3 px-1">
                    Enrolled Students
                </th>
                <th scope="col" class="py-3 px-1">
                    Verified
                </th>
                <th scope="col" class="py-3 px-1">
                    Status
                </th>
                <th scope="col" class="py-3 px-1">
                    <span class="sr-only">Manage Course</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($courses as $course)
            <tr class="bg-white border-b hover:bg-gray-50 text-center">
                <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $course->id }}
                </th>
                <td class="py-3 px-1 text-left">
                    {{ $course->title }}
                </td>
                <td class="py-3 px-1">
                    {{ $course->main_category }}
                </td>
                <td class="py-3 px-1">
                    {{ $course->sub_category }}
                </td>
                <td class="py-3 px-1">
                    {{ $course->instructor_id.': '.$course->first_name.' '.$course->last_name }}
                </td>
                <td class="py-3 px-1">
                    LKR {{ number_format($course->price, 2, ',', '.')  }}
                </td>
                <td class="py-3 px-1">
                    10
                </td>
                <td class="py-2 px-1">
                    @if($course->isVerified == true)
                    <i class="fa-regular fa-square-check text-green-600"></i>
                    @else
                    <i class="fa-regular fa-rectangle-xmark text-red-600"></i>
                    @endif
                </td>
                <td class="py-3 px-1">
                    @if($course->status == 'published')
                    <span class="text-green-700">published</span>
                    @elseif($course->status == 'blocked')
                    <span class="text-red-700">blocked</span>
                    @else
                    <span class="text-gray-700">{{ $course->status }}</span>
                    @endif
                </td>
                <td class="py-3 px-1 text-right">
                    @if($course->status == 'blocked')
                    <button type="button" onclick="changeUserStatus('{{ $course->id }}', 'published')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-green-500">Publish</button>
                    @else
                    <button type="button" onclick="changeUserStatus('{{ $course->id }}', 'blocked')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-red-500">Block</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $courses->links() !!}
</div>


<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token


    function changeUserStatus(courseId, status) {
        var formData = {
            courseId: courseId,
            status: status
        }

        $.ajax({
            method: 'PATCH',
            url: "{{ route('admin.course.changestatus') }}",
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data: formData,
        }).done(function(data) {
            console.log(data.data);
            location.reload();
        });

    }
</script>

@endsection