@extends('layouts.frontend')
@section('content')
@section('title',$contents->title)

<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')

<!-- Single Page Section -->
@include('components.vertikaltrip.single-page')

@endsection