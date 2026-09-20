@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Account{!! View::hasSection('account-title') ? ' :: ' . trim(View::getSection('account-title')) : '' !!}
=======
@section('title') 
    Account :: 
    @yield('account-title')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('sidebar')
    @include('account._sidebar')
@endsection

@section('content')
    @yield('account-content')
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
