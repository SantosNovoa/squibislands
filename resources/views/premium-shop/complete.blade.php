@extends('home.layout')

@section('title') Purchase Complete @endsection

@section('content')
    {!! breadcrumbs(['Premium Shop' => 'premium-shop', 'Purchase Complete' => 'premium-shop/complete']) !!}

    <div class="text-center py-5">
        <h1>Thank You!</h1>
        <p>Your purchase is being processed. Your rewards will appear in your account shortly.</p>
        <a href="{{ url('premium-shop') }}" class="btn btn-primary">Back to Shop</a>
    </div>
@endsection