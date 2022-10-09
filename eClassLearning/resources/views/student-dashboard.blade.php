@extends('layouts.default')

@section('content')

<div class="h-96">
    <h1>My Account</h1>

    @guest
    <h1 class="text-blue-600">Guest</h1>

    
    @endguest
</div>


@endsection