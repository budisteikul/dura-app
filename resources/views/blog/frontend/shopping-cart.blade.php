@extends('layouts.frontend')
@section('title','Order summary')
@section('content')
@include('layouts.loading')
<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')
<!-- Shopping Cart Section -->
@include('components.vertikaltrip.shopping-cart')
@endsection