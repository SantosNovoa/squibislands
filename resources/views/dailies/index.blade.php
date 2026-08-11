@extends('dailies.layout')

@section('dailies-title') Daily Index @endsection

@section('dailies-content')
{!! breadcrumbs([ucfirst(__('dailies.dailies')) => ucfirst(__('dailies.dailies'))]) !!}

<h1>
{{ucfirst(__('dailies.dailies'))}}
</h1>

<div class="row shops-row">
    @foreach($dailies as $daily)
    
        <div class="col-md-3 col-6 mb-3 text-center">
            @if($daily->has_image)
            <div class="daily-image">
                <a href="{{ $daily->url }}"><img src="{{ $daily->dailyImageUrl }}" alt="{{ $daily->name }}" /></a>
            </div>
            @endif
            <div class="daily-name mt-1">
                <a href="{{ $daily->url }}" class="h5 mb-0">{{ $daily->name }}</a>
            </div>
        </div>

    @endforeach

    <div class="col-md-3 col-6 mb-3 text-center d-flex flex-column justify-content-end">
        <div class="expedition-daily-image">
            <a href="{{ url('expeditions') }}">
                <img src="{{ asset('images/expedition.png') }}" alt="expedition-preview">
            </a>
        </div>
        <div class="expedition-daily-image mt-1">
            <a href="{{ url('expeditions') }}" class="h5 mb-0">Expeditions</a>
        </div>
    </div>
</div>

@endsection
