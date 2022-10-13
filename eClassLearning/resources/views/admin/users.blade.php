@php
$basePage = null;
$page = "users";
@endphp

@extends('layouts.admin')

@section('content')

<div>
    <h5 class="text-gray-700">Total Registered Users: {{ $totalUsers }}</h5>
</div>

<div class="relative shadow-md sm:rounded-lg mt-6">
    <table class="w-full text-sm text-left text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
            <tr>
                <th scope="col" class="py-3 px-4">
                    User ID
                </th>
                <th scope="col" class="py-3 px-4">
                    Email
                </th>
                <th scope="col" class="py-3 px-4">
                    Member Since
                </th>
                <th scope="col" class="py-3 px-4">
                    Last Profile Update
                </th>
                <th scope="col" class="py-3 px-4">
                    Role
                </th>
                <th scope="col" class="py-3 px-4">
                    User Status
                </th>
                <th scope="col" class="py-3 px-4">
                    <span class="sr-only">Block/ Unblock</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $user->id }}
                </th>
                <td class="py-3 px-4">
                    {{ $user->email }}
                </td>
                <td class="py-3 px-4">
                    {{ $user->created_at }}
                </td>
                <td class="py-3 px-4">
                    {{ $user->updated_at }}
                </td>
                <td class="py-3 px-4">
                    {{ $user->role }}
                </td>
                <td class="py-3 px-4">
                    @if($user->status == 1)
                    <span class="text-green-700">active</span>
                    @else
                    <span class="text-red-700">blocked</span>
                    @endif
                </td>
                <td class="py-3 px-4 text-right">
                    @if($user->status == 1)
                    <button type="button" onclick="changeUserStatus('{{ $user->id }}', 'blocked')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-red-500">Block</button>
                    @else
                    <button type="button" onclick="changeUserStatus('{{ $user->id }}', 'active')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-green-500">Activate</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $users->links() !!}
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