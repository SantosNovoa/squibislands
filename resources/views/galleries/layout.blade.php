@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Gallery{!! View::hasSection('gallery-title') ? ' :: ' . trim(View::getSection('gallery-title')) : '' !!}
=======
@section('title') 
    Gallery :: @yield('gallery-title')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('sidebar')
    @include('galleries._sidebar')
@endsection

@section('content')
    @yield('gallery-content')
@endsection

@section('scripts')
<<<<<<< HEAD
    @parent
@endsection
=======
@parent
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
