@extends('layouts.instructor')

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
            <th scope="col" class="py-3 px-4">
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
            <td class="py-3 px-4">
                @if($question->status == "pending")
                <a type="button" href="{{ route('instructor.answerQuestion', $question->id) }}" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-green-500">Answer</a>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $questions->links() !!}
</div>


<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    $("#submit").click(function(e) {
        e.preventDefault();

        var formData = {
            amount: $("#amount").val(),
            balance: $("#balance").val(),
        };

        $.ajax({
            method: 'POST',
            url: "{{ route('instructor.requestwithdraw') }}",
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data: formData,
        }).done(function(data) {
            $("span").remove(".validation-error"); // Remove Error Messages
            // Check For Errors
            if (data.error != undefined) {
                // Error Message
                $.each(data.error, function(key, value) {
                    $(`#` + key).after(`<span class="validation-error mt-2 text-sm text-red-600 dark:text-red-500">` + value + `</span>`);
                });
            } else {
                console.log(data.success);
                location.reload();

            }
        });

    });
</script>

<!-- Content Ends -->
@endsection