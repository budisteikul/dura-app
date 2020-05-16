@extends('layouts.frontend')
@section('content')
@section('title',$contents->title)
@if($contents->excerpt!="")
@section('description',$contents->excerpt)
@endif
<!-- Navbar Section -->
@include('components.vertikaltrip.navbar')

<!-- Single Page Section -->
@include('components.vertikaltrip.single-page')
@endsection