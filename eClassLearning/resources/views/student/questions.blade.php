@extends('layouts.student')

@php

$title = "questions";

@endphp

@section('content')
<!-- Content Starts -->

<table class="w-full text-sm text-left text-gray-500">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50">
        <tr>
            <th scope="col" class="py-3 px-4">
                ID
            </th>
            <th scope="col" class="py-3 px-4">
                Created At
            </th>
            <th scope="col" class="py-3 px-4">
                Course Title
            </th>
            <th scope="col" class="py-3 px-4">
                Question
            </th>
            <th scope="col" class="py-3 px-4">
                Answer
            </th>
            <th scope="col" class="py-3 px-4">
                Status
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($questions as $question)
        <tr class="bg-white border-b hover:bg-gray-50">
            <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                {{ $question->id }}
            </th>
            <td class="py-3 px-4">
                {{ $question->created_at }}
            </td>
            <td class="py-3 px-4">
                {{ $question->title }}
            </td>
            <td class="py-3 px-4">
                {{ $question->question }}
            </td>
            <td class="py-3 px-4">
                {{ $question->answer }}
            </td>
            <td class="py-3 px-4">
                {{ $question->status }}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $questions->links() !!}
</div>


<!-- Content Ends -->
@endsection