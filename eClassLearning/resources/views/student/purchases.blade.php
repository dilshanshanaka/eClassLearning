@extends('layouts.student')

@php

$title = "purchases";

@endphp

@section('content')
<!-- Content Starts -->

<h4 class="my-3 text-bold text-lg text-gray-900">My Purchase History</h4>

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
                    {{ $purchase->status }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<!-- Content Ends -->
@endsection