@extends('layouts.frontend')
@section('content')
@include('layouts.loading')

<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')

<!-- Receipt Section -->
@include('components.vertikaltrip.receipt')

@endsection