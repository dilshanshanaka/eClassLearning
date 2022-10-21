@php
$basePage = null;
$page = "appointments";
@endphp

@extends('layouts.admin')

@section('content')


<div class="relative shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-4">
                    ID
                </th>
                <th scope="col" class="py-3 px-4">
                    Date
                </th>
                <th scope="col" class="py-3 px-4">
                    Student Name
                </th>
                <th scope="col" class="py-3 px-4">
                    Instructor Name
                </th>
                <th scope="col" class="py-3 px-4">
                    Start Time
                </th>
                <th scope="col" class="py-3 px-4">
                    End Time
                </th>
                <th scope="col" class="py-3 px-4">
                    Details
                </th>
                <th scope="col" class="py-3 px-4">
                    Created Date & Time
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
                    {{ $appointment->student_first_name. ' ' .$appointment->student_last_name  }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->instructor_first_name. ' ' .$appointment->instructor_last_name  }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->start_time }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->end_time }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->details }}
                </td>
                <td class="py-3 px-4">
                    {{ $appointment->created_at }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $appointments->links() !!}
</div>

@endsection