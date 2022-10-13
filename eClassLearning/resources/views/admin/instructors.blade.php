@php
$basePage = "users";
$page = "instructors";
@endphp

@extends('layouts.admin')

@section('content')

<div>
    <h5 class="text-gray-700">Total Registered Instructors: {{ $totalInstructors }}</h5>
</div>

<div class="relative shadow-md sm:rounded-lg mt-8">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-2 px-4">
                    Instructor ID
                </th>
                <th scope="col" class="py-2 px-4">
                    User ID
                </th>
                <th scope="col" class="py-2 px-4">
                    Name
                </th>
                <th scope="col" class="py-2 px-4">
                    Email
                </th>
                <th scope="col" class="py-2 px-4">
                    NIC
                </th>
                <th scope="col" class="py-2 px-4">
                    City
                </th>
                <th scope="col" class="py-2 px-4">
                    Member Since
                </th>
                <th scope="col" class="py-2 px-4">
                    Verified
                </th>
                <th scope="col" class="py-2 px-4">
                    User Status
                </th>
                <th scope="col" class="py-2 px-4">
                    <span class="sr-only">Manage</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($instructors as $instructor)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="py-2 px-6 font-medium text-gray-900 whitespace-nowrap">
                    {{ $instructor->id }}
                </th>
                <td class="py-2 px-6">
                    {{ $instructor->user_id }}
                </td>
                <td class="py-2 px-6">
                    {{ $instructor->first_name.' '.$instructor->last_name }}
                </td>
                <td class="py-2 px-6">
                    {{ $instructor->email }}
                </td>
                <td class="py-2 px-6">
                    {{ $instructor->nic }}
                </td>
                <td class="py-2 px-6">
                    {{ $instructor->city }}
                </td>
                <td class="py-2 px-6">
                    {{ $instructor->created_at }}
                </td>
                <td class="py-2 px-6">
                    @if($instructor->isVerified == true)
                    <i class="fa-regular fa-square-check text-green-600"></i>
                    @else
                    <i class="fa-regular fa-rectangle-xmark text-red-600"></i>
                    @endif
                </td>
                <td class="py-2 px-6">
                    @if($instructor->status == 1)
                    <span class="text-green-700">active</span>
                    @else
                    <span class="text-red-700">blocked</span>
                    @endif
                </td>
                <td class="py-2 text-center">
                    @if($instructor->isVerified == true)
                    <button type="button" onclick="changeUserVerify('{{ $instructor->user_id }}', 'unverify')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-red-500 mb-1">Unverify</button>
                    @else
                    <button type="button" onclick="changeUserVerify('{{ $instructor->user_id }}', 'verify')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-green-500 mb-1">Verify</button>
                    @endif
                    @if($instructor->status == 1)
                    <button type="button" onclick="changeUserStatus('{{ $instructor->user_id }}', 'blocked')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-red-500">Block</button>
                    @else
                    <button type="button" onclick="changeUserStatus('{{ $instructor->user_id }}', 'active')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-green-500">Activate</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $instructors->links() !!}
</div>

<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token


    function changeUserStatus(userId, status) {
        var formData = {
            userId: userId,
            status: status
        }

        $.ajax({
            method: 'PATCH',
            url: "{{ route('admin.user.changestatus') }}",
            headers: {
                'X-CSRF-TOKEN': _token
            },
            data: formData,
        }).done(function(data) {
            console.log(data.data);
            location.reload();
        });

    }

    function changeUserVerify(userId, status) {
        var formData = {
            userId: userId,
            status: status
        }

        $.ajax({
            method: 'PATCH',
            url: "{{ route('admin.user.changeverification') }}",
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