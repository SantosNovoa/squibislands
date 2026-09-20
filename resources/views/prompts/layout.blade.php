@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Prompts{!! View::hasSection('prompts-title') ? ' :: ' . trim(View::getSection('prompts-title')) : '' !!}
=======
@section('title') 
    Prompts :: 
    @yield('prompts-title')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('sidebar')
    @include('prompts._sidebar')
@endsection

@section('content')
    @yield('prompts-content')
@endsection

@section('scripts')
<<<<<<< HEAD
    @parent
@endsection
=======
@parent
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
