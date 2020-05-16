@extends('layouts.frontend')
@section('title','Book '. $contents->title)
@section('content')
@include('layouts.loading')
<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')
<!-- Time Selector Section -->
@include('components.vertikaltrip.time-selector')
@endsection