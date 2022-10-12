@extends('layouts.instructor')

@php

$title = "dashboard";

@endphp

@section('content')
<!-- Content Starts -->



<div class="my-10">
@foreach ($courses as $course)
<h4>{{ $course->subCategory->title }}</h4>
@endforeach
</div>

<!-- Content Ends -->
@endsection