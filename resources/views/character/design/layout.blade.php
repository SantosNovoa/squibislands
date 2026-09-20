@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Design Approvals{!! View::hasSection('design-title') ? ' :: ' . trim(View::getSection('design-title')) : '' !!}
=======
@section('title') 
    @yield('design-title')
>>>>>>> Cylunny/extension/polls-and-forms
@endsection

@section('sidebar')
    @include('character.design._sidebar')
@endsection

@section('content')
    @yield('design-content')
@endsection

@section('scripts')
<<<<<<< HEAD
    @parent
@endsection
=======
@parent
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
