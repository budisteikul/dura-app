@extends('layouts.frontend')
@section('title','Book '. $product_id->title)
@section('content')
<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')
<!-- Time Selector Section -->
@include('components.vertikaltrip.time-selector')
@endsection