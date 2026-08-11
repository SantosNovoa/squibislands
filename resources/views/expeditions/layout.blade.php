@extends('layouts.app')

@section('title') 
    Expeditions :: 
    @yield('expeditions-title')
@endsection

@section('sidebar')
    @include('expeditions._sidebar')
@endsection

@section('content')
    @yield('expeditions-content')
@endsection

@section('scripts')
@parent
@endsection