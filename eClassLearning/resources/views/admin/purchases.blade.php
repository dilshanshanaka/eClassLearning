@php
$basePage = null;
$page = "purchases";
@endphp

@extends('layouts.admin')

@section('content')

<div class="mt-6">
    <h5 class="text-gray-700 font-bold">Total Sales: LKR {{ number_format($sales, 2, '.', ',') }}</h5>
    <h5 class="text-gray-700 mt-2 font-bold">Total Profit: LKR {{ number_format($profit, 2, '.', ',') }}</h5>
</div>

<div class="relative shadow-md sm:rounded-lg mt-6">
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
                <th scope="col" class="py-3 px-4">
                    Student ID
                </th>
                <th scope="col" class="py-3 px-4">
                    Instructor ID
                </th>
                <th scope="col" class="py-3 px-4">
                    Status
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
                <td class="py-3 px-4">
                    {{ $purchase->student_id }}
                </td>
                <td class="py-3 px-4">
                    {{ $purchase->instructor_id }}
                </td>
                <td class="py-3 px-4">
                    {{ $purchase->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


<div class="d-flex justify-content-center pt-14 pb-6 px-4">
    {!! $purchases->links() !!}
</div>

@endsection