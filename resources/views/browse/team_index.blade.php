@extends('layouts.app')
@section('title') Team @endsection
@section('content')
{!! breadcrumbs(['Team' => 'team']) !!}
<h1>{{ config('lorekeeper.settings.site_name') }} Team</h1>
<hr>

@foreach($ranks as $rank)
    @if(isset($staff[$rank->id]) && count($staff[$rank->id]))
        <h3 class="my-3 text-center" style="color: #{{ $rank->color }}">
            <i class="{{ $rank->icon }}"></i> {{ $rank->name }}
        </h3>
        <p class="text-center">{!! $rank->parsed_description !!}</p>
        
        @foreach($staff[$rank->id]->chunk(4) as $chunk)
            <div class="row justify-content-center">
                @foreach($chunk as $user)
                    <div class="col-12 col-md-6 mb-3">
                        @include('browse._staff_listing_content')
                    </div>
                @endforeach
            </div>
        @endforeach
        <hr>
    @endif
@endforeach

@endsection