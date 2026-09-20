@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Admin{!! View::hasSection('admin-title') ? ' :: ' . trim(View::getSection('admin-title')) : '' !!}
=======
@section('title') 
    Admin :: 
    @yield('admin-title')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('sidebar')
    @include('admin._sidebar')
@endsection

@section('content')
    @yield('admin-content')
@endsection

@section('scripts')
<<<<<<< HEAD
    @parent
@endsection
=======
@parent
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
