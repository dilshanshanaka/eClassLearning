@php
$basePage = null;
$page = "withdrawals";
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
                    Instructor Name
                </th>
                <th scope="col" class="py-3 px-4">
                    Mobile
                </th>
                <th scope="col" class="py-3 px-4">
                    Instructor ID
                </th>
                <th scope="col" class="py-3 px-4">
                    Amount
                </th>
                <th scope="col" class="py-3 px-4">
                    Requested Date
                </th>
                <th scope="col" class="py-3 px-4">
                    Status
                </th>
                <th scope="col" class="py-3 px-4">
                    <span class="sr-only">Accept</span>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($withdrawals as $withdraw)
            <tr class="bg-white border-b hover:bg-gray-50">
                <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                    {{ $withdraw->id }}
                </th>
                <td class="py-3 px-4">
                    {{ $withdraw->first_name .' '. $withdraw->last_name  }}
                </td>
                <td class="py-3 px-4">
                    {{ $withdraw->mobile }}
                </td>
                <td class="py-3 px-4">
                    {{ $withdraw->instructorId }}
                </td>
                <td class="py-3 px-4">
                    LKR {{ number_format($withdraw->amount, 2, '.', ',') }}
                </td>
                <td class="py-3 px-4">
                    {{ $withdraw->created_at }}
                </td>
                <td class="py-3 px-4">
                    {{ $withdraw->status }}
                </td>
                <td class="py-3 px-4">
                    @if($withdraw->status == "pending")
                    <button type="button" onclick="approve('{{ $withdraw->id }}','approved')" class="font-medium text-white px-2 py-1 rounded-md hover:underline bg-green-500">Approve</button>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $withdrawals->links() !!}
</div>

<script>
    _token = $('meta[name="csrf-token"]').attr('content'); // CSRF Token


    function approve(id, status) {
        var formData = {
            withdrawId: id,
            status: status
        }

        $.ajax({
            method: 'PATCH',
            url: "{{ route('admin.accept-withdarw') }}",
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