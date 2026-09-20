@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    Character Masterlist
@endsection
=======
@section('title') Character Masterlist @endsection
>>>>>>> Cylunny/extension/polls-and-forms

@section('sidebar')
    @include('browse._sidebar')
@endsection

@section('content')
<<<<<<< HEAD
    {!! breadcrumbs(['Character Masterlist' => 'masterlist']) !!}
    <h1>Character Masterlist</h1>

    @include('browse._masterlist_content', ['characters' => $characters])
@endsection

@section('scripts')
    @include('browse._masterlist_js')
@endsection
=======
{!! breadcrumbs(['Character Masterlist' => 'masterlist']) !!}
<h1>Character Masterlist</h1>

@include('browse._masterlist_content', ['characters' => $characters])

@endsection

@section('scripts')
@include('browse._masterlist_js')
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
