@extends('layouts.instructor')

@php

$title = "withdraw";

@endphp

@section('content')
<!-- Content Starts -->


<h4 class="text-xl text-gray-800 font-bold mb-3">My Account Balance: LKR {{ number_format($balance, 2, '.', ',') }}</h4>
<div class="flex space-x-8 justify-between">
    <h4 class="text-lg text-gray-600 font-bold">Total Earnings: LKR {{ number_format($earnings, 2, '.', ',') }}</h4>
    <h4 class="text-lg text-gray-600 font-bold">Pending Withdrawals: LKR {{ number_format($totalPendingWithdraw, 2, '.', ',') }}</h4>
</div>

<hr class="my-4">

<div class="flex space-x-8">
    <div class="basis-3/4">
        <table class="w-full text-sm text-left text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                <tr>
                    <th scope="col" class="py-3 px-4">
                        ID
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
                </tr>
            </thead>
            <tbody>
                @foreach($withdrawals as $withdraw)
                <tr class="bg-white border-b hover:bg-gray-50">
                    <th scope="row" class="py-3 px-4 font-medium text-gray-900 whitespace-nowrap">
                        {{ $withdraw->id }}
                    </th>
                    <td class="py-3 px-4">
                        LKR {{ number_format($withdraw->amount, 2, '.', ',') }}
                    </td>
                    <td class="py-3 px-4">
                        {{ $withdraw->created_at }}
                    </td>
                    <td class="py-3 px-4">
                        {{ $withdraw->status }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center pt-14 pb-6 px-4">
            {!! $withdrawals->links() !!}
        </div>

    </div>

    <div class="basis-1/3">
        <h4 class="text-lg text-gray-600 font-semibold">Request a withdraw</h4>
        <div class="form-row mt-3">
            <span class="block text-md font-medium text-slate-700">Amount (LKR)</span>
            <input type="text" hidden id="balance" value="{{ $earnings }}">
            <input id="amount" type="text" class="mt-1 border border-gray-300 drop-shadow rounded-md w-full h-8 px-3">
            <button id="submit" type="submit" class="mt-6 py-2 px-3 bg-gradient-to-r from-sky-400 to-sky-700 text-white rounded-md 
                            shadow font-semibold bg hover:from-blue-700 hover:to-sky-400 transition duration-300 w-full">
                Submit
            </button>
        </div>
    </div>
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