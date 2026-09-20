@extends('layouts.app')

<<<<<<< HEAD
@section('title')
    {{ $sublist->name }} Masterlist
@endsection
=======
@section('title') {{ $sublist->name }} Masterlist @endsection
>>>>>>> Cylunny/extension/polls-and-forms

@section('sidebar')
    @include('browse._sidebar')
@endsection

@section('content')
<<<<<<< HEAD
    {!! breadcrumbs([$sublist->name . ' Masterlist' => $sublist->key]) !!}
    <h1>{{ $sublist->name }} Masterlist</h1>

    @include('browse._masterlist_content', ['characters' => $characters])
@endsection

@section('scripts')
    @include('browse._masterlist_js')
@endsection
=======
{!! breadcrumbs([$sublist->name.' Masterlist' => $sublist->key ]) !!}
<h1>{{ $sublist->name }} Masterlist</h1>

@include('browse._masterlist_content', ['characters' => $characters])

@endsection

@section('scripts')
@include('browse._masterlist_js')
@endsection
>>>>>>> Cylunny/extension/polls-and-forms
