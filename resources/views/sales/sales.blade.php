<<<<<<< HEAD
@extends('sales.layout')

@section('sales-title')
    {{ $sales->title }}
@endsection

@section('sales-content')
    {!! breadcrumbs(['Site Sales' => 'sales', $sales->title => $sales->url]) !!}
    @include('sales._sales', ['sales' => $sales, 'page' => true])

    <hr class="mb-5" id="commentsSection" />
    @if ((isset($sales->comments_open_at) && $sales->comments_open_at < Carbon\Carbon::now()) || (Auth::check() && (Auth::user()->hasPower('manage_sales') || Auth::user()->hasPower('comment_on_sales'))) || !isset($sales->comments_open_at))
        @comments(['model' => $sales, 'perPage' => 5])
    @else
        <div class="alert alert-warning text-center">
            <p>Comments for this sale aren't open yet! They will open {!! pretty_date($sales->comments_open_at) !!}.</p>
        </div>
    @endif
=======
@extends('layouts.app')

@section('title') {{ $sales->title }} @endsection

@section('content')
    {!! breadcrumbs(['Site Sales' => 'sales', $sales->title => $sales->url]) !!}
    @include('sales._sales', ['sales' => $sales, 'page' => TRUE])

@if((isset($sales->comments_open_at) && $sales->comments_open_at < Carbon\Carbon::now() || 
    (Auth::check() && Auth::user()->hasPower('edit_pages'))) || 
    !isset($sales->comments_open_at))
        <hr>
        <br><br>
        @comments(['model' => $sales,
                'perPage' => 5
            ])
@else
    <div class="alert alert-warning text-center">
        <p>Comments for this sale aren't open yet! They will open {!! pretty_date($sales->comments_open_at) !!}.</p>
    </div>
@endif

>>>>>>> Cylunny/extension/polls-and-forms
@endsection
