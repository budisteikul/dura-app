@extends('layouts.frontend')
@section('title','Receipt')
@section('content')
@include('layouts.loading')
<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')
<!-- Receipt Section -->
@include('components.vertikaltrip.receipt')
@endsection