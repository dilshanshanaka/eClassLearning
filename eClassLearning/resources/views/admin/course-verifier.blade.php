@php
$basePage = "users";
$page = "course verifiers";
@endphp

@extends('layouts.admin')

@section('content')

<div class="flex justify-between">
    <h5 class="text-gray-700">Total Course Verifier: {{ $totalCourseVerifiers }}</h5>
    <a href="{{ route('admin.users.add-course-verifiers') }}" class="font-medium text-white px-2 py-1 rounded-md hover:bg-blue-700 bg-blue-500">Add New</a>
</div>

<div class="relative shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-4">
                    Course Verifier ID
                </th>
                <th scope="col" class="py-3 px-4">
                    User ID
                </th>
                <th scope="col" class="py-3 px-4">
                    Name
                </th>
                <th scope="col" class="py-3 px-4">
                    Email
                </th>
                <th scope="col" class="py-3 px-4">
                    Mobile
                </th>
                <th scope="col" class="py-3 px-4">
                    Education
                </th>
                <th scope="col" class="py-3 px-4">
                    Member Since
                </th>

                <th scope="col" class="py-3 px-4">
                    User Status
                </th>
                <th scope="col" class="py-3 px-4">
                    <span class="sr-only">Manage User</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($courseVerifiers as $courseVerifier)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $courseVerifier->id }}
                </th>
                <td class="py-3 px-4">
                    {{ $courseVerifier->user_id }}
                </td>
                <td class="py-3 px-4">
                    {{ $courseVerifier->first_name.' '.$courseVerifier->last_name }}
                </td>
                <td class="py-3 px-4">
                    {{ $courseVerifier->email }}
                </td>
                <td class="py-3 px-4">
                    {{ $courseVerifier->mobile }}
                </td>
                <td class="py-3 px-4">
                    {{ $courseVerifier->highest_education }}
                </td>
                <td class="py-3 px-4">
                    {{ $courseVerifier->created_at }}
                </td>
                <td class="py-3 px-4">
                    @if($courseVerifier->status == 1)
                    <span class="text-green-700">active</span>
                    @else
                    <span class="text-red-700">blocked</span>
                    @endif
                </td>
                <td class="py-3 px-4 text-right">
                    <a type="button" href="{{ route('admin.users.edit-course-verifiers', $courseVerifier->id) }}" class="font-medium text-white px-4 py-1 mb-2 rounded-md hover:bg-blue-700 bg-blue-500">Edit</a>

                    @if($courseVerifier->status == 1)
                    <button type="button" onclick="changeUserStatus('{{ $courseVerifier->user_id }}', 'blocked')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-red-500">Block</button>
                    @else
                    <button type="button" onclick="changeUserStatus('{{ $courseVerifier->user_id }}', 'active')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-green-500">Activate</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $courseVerifiers->links() !!}
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
</script>

@endsection