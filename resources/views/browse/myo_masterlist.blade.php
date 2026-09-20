@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    MYO Slot Masterlist
@endsection
=======
@section('title') MYO Slot Masterlist @endsection
>>>>>>> Cylunny/extension/polls-and-forms

@section('sidebar')
    @include('browse._sidebar')
@endsection

@section('content')
<<<<<<< HEAD
    {!! breadcrumbs(['MYO Slot Masterlist' => 'myos']) !!}
    <h1>MYO Slot Masterlist</h1>

    @include('browse._masterlist_content', ['characters' => $slots])
@endsection

@section('scripts')
    @include('browse._masterlist_js')
@endsection
=======
{!! breadcrumbs(['MYO Slot Masterlist' => 'myos']) !!}
<h1>MYO Slot Masterlist</h1>

@include('browse._masterlist_content', ['characters' => $slots])

@endsection

@section('scripts')
@include('browse._masterlist_js')
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
