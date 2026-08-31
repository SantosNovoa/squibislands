@extends('layouts.app')

@section('sidebar')
    @include('premium-shop._sidebar')
@endsection

@section('content')
    @yield('premium-shop-content')
@endsection

{{-- @section('scripts')
    @parent
@endsection --}}
