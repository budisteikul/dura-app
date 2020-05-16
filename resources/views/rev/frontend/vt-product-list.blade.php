@extends('layouts.frontend')
@section('title',$contents->title)
@section('content')
<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')
<!-- Single Tour Section -->
@include('components.vertikaltrip.single-tour')
@endsection