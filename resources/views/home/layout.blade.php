@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Home{!! View::hasSection('home-title') ? ' :: ' . trim(View::getSection('home-title')) : '' !!}
=======
@section('title') 
    Home :: 
    @yield('home-title')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('sidebar')
    @include('home._sidebar')
@endsection

@section('content')
    @yield('home-content')
@endsection

@section('scripts')
<<<<<<< HEAD
    @parent
@endsection
=======
@parent
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
