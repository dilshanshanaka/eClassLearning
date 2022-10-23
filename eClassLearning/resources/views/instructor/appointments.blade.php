@extends('layouts.instructor')

@php

$title = "appointments";

@endphp

@section('content')
<!-- Content Starts -->
@if($instructorAppointment == NULL)
<h3 class="text-gray-800 text-center text-2xl font-bold">Enable Appointment</h3>

<div class="grid gap-6 mb-6 md:grid-cols-4 mt-6">
    <div>
        <span class="block text-sm font-medium text-slate-700 mb-2">Start Time</span>
        <input id="startTime" type="time" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full ">
    </div>
    <div>
        <span class="block text-sm font-medium text-slate-700 mb-2">End Time</span>
        <input id="endTime" type="time" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full">
    </div>
    <div>
        <span class="block text-sm font-medium text-slate-700 mb-2">Charge per session (LKR)</span>
        <input id="charge" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full " placeholder="1500">
    </div>
</div>

<button id="create" class="rounded-full px-3 py-3 bg-green-700 hover::bg-green-900 text-sm text-white">Enable Appointments</button>

@else

<div class="flex space-x-8">
    @if($instructorAppointment->status == 0)
    <h4 class="text-gray-800 text-md font-semibold">Availability : <span class="text-gray-600">unavailable</span></h4>
    <button class="rounded-full px-3 py-1 bg-blue-500 hover::bg-blue-800 text-sm text-white" onclick="changeStatus('unavailable')">Change Status</button>

    @else
    <h4 class="text-gray-800 text-md font-semibold">Availability : <span class="text-green-600">available</span></h4>
    <button class="rounded-full px-3 py-1 bg-blue-500 hover::bg-blue-800 text-sm text-white" onclick="changeStatus('available')">Change Status</button>
    @endif
</div>


<div class="grid gap-6 mb-6 md:grid-cols-4 mt-3">
    <div>
        <span class="block text-sm font-medium text-slate-700 mb-2">Start Time</span>
        <input id="startTime" type="time" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" value="{{ $instructorAppointment->start_time }}">
    </div>
    <div>
        <span class="block text-sm font-medium text-slate-700 mb-2">End Time</span>
        <input id="endTime" type="time" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full" value="{{ $instructorAppointment->end_time }}">
    </div>
    <div>
        <span class="block text-sm font-medium text-slate-700 mb-2">Charge per session (LKR)</span>
        <input id="charge" type="text" class="border border-gray-300 drop-shadow rounded-md block p-2 w-full " value="{{ $instructorAppointment->charge_per_hour }}">
    </div>
</div>

<button id="update" class="rounded-full mb-3 px-5 py-1 bg-green-700 hover::bg-green-900 text-sm text-white">Update</button>


<hr>

<div class="my-3">
    <h3 class="text-xl text-gray-800 font-semibold">Appointments</h3>

    <table class="w-full text-sm text-left text-gray-500 mt-3">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-4">
                    ID
                </th>
                <th scope="col" class="py-3 px-4">
                    Date
                </th>
                <th scope="col" class="py-3 px-4">
                    Start Time
                </th>
                <th scope="col" class="py-3 px-4">
                    End Time
                </th>
                <th scope="col" class="py-3 px-4">
                    Student Name
                </th>
                <th scope="col" class="py-3 px-4">
                    Details
                </th>
                <th scope="col" class="py-3 px-4">
                    <span class="sr-only">Add Meeting Details</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $appointment->id }}
                </th>
                <td class="py-3 px-4">
                    {{ $appointment->date }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->start_time }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->end_time }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->first_name .' '.$appointment->last_name  }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->details }}
                </td>
                <td class="py-3 px-4 text-right">
                    <button type="button" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-blue-500">Add Details</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center pt-14 pb-6 px-4">
        {!! $appointments->links() !!}
    </div>
</div>


@endif



<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token

    $("#create").click(function(e) {
        e.preventDefault();

        var formData = {
            startTime: $("#startTime").val(),
            endTime: $("#endTime").val(),
            charge: $("#charge").val(),
        };

        $.ajax({
            method: 'POST',
            url: "{{ route('instructor.addavailability') }}",
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
                location.reload();
            }
        });
    });

    function changeStatus(status) {
        var formData = {
            status: status
        }

        $.ajax({
            method: 'PATCH',
            url: "{{ route('instructor.changeavailability') }}",
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data: formData,
        }).done(function(data) {
            console.log(data.data);
            location.reload();
        });
    }

    $("#update").click(function(e) {
        e.preventDefault();

        var formData = {
            startTime: $("#startTime").val(),
            endTime: $("#endTime").val(),
            charge: $("#charge").val(),
        };

        $.ajax({
            method: 'PATCH',
            url: "{{ route('instructor.updateavailability') }}",
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
                location.reload();
            }
        });
    });
</script>


<!-- Content Ends -->
@endsection