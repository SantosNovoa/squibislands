@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Shops{!! View::hasSection('shops-title') ? ' :: ' . trim(View::getSection('shops-title')) : '' !!}
=======
@section('title') 
    Shops :: 
    @yield('shops-title')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('sidebar')
    @include('shops._sidebar')
@endsection

@section('content')
    @yield('shops-content')
@endsection

@section('scripts')
<<<<<<< HEAD
    @parent
@endsection
=======
@parent
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
