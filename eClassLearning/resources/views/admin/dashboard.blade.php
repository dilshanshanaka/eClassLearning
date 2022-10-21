@php
$basePage = null;
$page = "dashboard";
@endphp

@extends('layouts.admin')

@section('content')

<div class="flex space-x-8 my-6">
    <div class="basis-1/4 text-center shadow-2xl rounded p-8">
        <h4 class="text-gray-800 text-2xl font-bold mb-2">Total Courses</h4>
        <h4 class="text-gray-800 text-3xl font-bold">{{ $totalCourses }}</h4>
    </div>
    <div class="basis-1/4 text-center shadow-2xl rounded p-8">
        <h4 class="text-gray-800 text-2xl font-bold mb-2">Students</h4>
        <h4 class="text-gray-800 text-3xl font-bold">{{ $totalStudents }}</h4>
    </div>
    <div class="basis-1/4 text-center shadow-2xl rounded p-8">
        <h4 class="text-gray-800 text-2xl font-bold mb-2">Instructors</h4>
        <h4 class="text-gray-800 text-3xl font-bold">{{ $totalInstructors }}</h4>
    </div>
    <div class="basis-1/4 text-center shadow-2xl rounded p-8">
        <h4 class="text-gray-800 text-2xl font-bold mb-2">Sales</h4>
        <h4 class="text-gray-800 text-xl font-bold">LKR {{ number_format($totalSales, 2, '.', ',') }} </h4>
    </div>
</div>

<div class="flex space-x-8 mt-10">
    <div class="basis-1/2 shadow-2xl rounded p-8">
        <h4 class="text-gray-800 text-xl font-bold mb-2">Latest Purchases</h4>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-4">
                        ID
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Date & Time
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Type
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Description
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Amount
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($purchases as $purchase)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $purchase->id }}
                    </th>
                    <td class="py-3 px-4">
                        {{ $purchase->created_at }}
                    </td>
                    <td class="py-3 px-4">
                        {{ $purchase->type }}
                    </td>
                    <td class="py-3 px-4">
                        {{ $purchase->description }}
                    </td>
                    <td class="py-3 px-4">
                        LKR {{ number_format($purchase->amount, 2, '.', ',') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="basis-1/2 shadow-2xl rounded p-8">
        <h4 class="text-gray-800 text-xl font-bold mb-2">New Courses</h4>
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-4">
                        ID
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Title
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Price
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Status
                    </th>
                    <th scope="col" class="py-3 px-4">
                        Created At
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($courses as $course)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $course->id }}
                    </th>
                    <td class="py-3 px-4">
                        {{ $course->title }}
                    </td>
                    <td class="py-3 px-4">
                        LKR {{ number_format($course->price, 2, '.', ',') }}
                    </td>
                    <td class="py-3 px-4">
                        {{ $course->status }}

                    </td>
                    <td class="py-3 px-4">
                        {{ $course->craeted_at }}

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection