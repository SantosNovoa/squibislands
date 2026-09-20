@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Home
@endsection

@section('sidebar')
    @if(Auth::check())
       @include('frontpage._sidebar')
    @endif
    @include('pages._sidebar')
@endsection

@section('content')
    @if (Auth::check())
=======
@section('title') Home @endsection

@section('content')
    @if(Auth::check())
>>>>>>> Cylunny/extension/polls-and-forms
        @include('pages._dashboard')
    @else
        @include('pages._logged_out')
    @endif
@endsection
<<<<<<< HEAD

{{-- @section('sidebar')
    @include('pages._sidebar')
@endsection --}}
=======
>>>>>>> Cylunny/extension/polls-and-forms
