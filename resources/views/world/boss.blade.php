@extends('world.layout')

@section('world-title')
    {{ $boss->name }}
@endsection

@section('meta-img')
    {{ $boss->imageUrl }}
@endsection


@section('content')
    <x-admin-edit title="Boss" :object="$boss" />
    {!! breadcrumbs(['World' => 'world', 'Bosss' => 'world/bosss', $boss->name => $boss->idUrl]) !!}

    <div class="row">
        <div class="col-sm">
        </div>
        <div class="col-lg-6 col-lg-10">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row world-entry">
                        @if ($boss->imageUrl)
                            <div class="col-md-3 world-entry-image">
                                <a href="{{ $boss->imageUrl }}" data-lightbox="entry" data-title="{{ $boss->name }}">
                                    <img src="{{ $boss->imageUrl }}" class="world-entry-image" alt="{{ $name }}" />
                                </a>
                            </div>
                        @endif
                        <div class="{{ $boss->imageUrl ? 'col-md-9' : 'col-12' }}">
                            <h1>
                                @if (!$boss->is_active)
                                    <i class="fas fa-eye-slash mr-1"></i>
                                @endif
                                {!! $boss->name !!}
                            </h1>
                            <div class="progress h5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 100%" aria-valuenow="{{ $boss->total_health }}" aria-valuemin="0" aria-valuemax="{{ $boss->total_health }}">
                                    {{ $boss->total_health }} / {{ $boss->total_health }}
                                </div>
                            </div>
                            <div class="world-entry-text">
                                {!! $boss->description !!}
                                @if (!$boss->isActive())
                                    <div class="alert alert-secondary mt-3">
                                        <i class="fas fa-exclamation-triangle"></i> This boss has {{ $boss->current_health < 1 ? 'been defeated' : 'been challenged' }} and is no longer active.
                                        @if ($boss->end_at)
                                            This boss was active until {!! pretty_date($boss->end_at) !!}.
                                        @endif
                                    </div>
                                    @if ($boss->stage_images)
                                        <h5>Boss Stages</h5>
                                        <div class="row mt-3">
                                            @php
                                                $sortedStages = $boss->getStageImages();
                                                krsort($sortedStages);
                                            @endphp
                                            @foreach ($sortedStages as $health => $stageImage)
                                                <div class="col-md-2">
                                                    <a href="{{ $stageImage['image'] }}" data-lightbox="entry" data-title="{{ $health }}">
                                                        <img src="{{ $stageImage['image'] }}" class="img-fluid my-auto" alt="{{ $health }}" />
                                                    </a>
                                                    <div class="text-center mt-2">
                                                        {{ $health }}% Health
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                @else
                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-calendar"></i> This boss is active
                                        {!! $boss->start_at ? 'from ' . pretty_date($boss->start_at) : 'from the beginning of time' !!}
                                        {!! $boss->end_at ? 'until ' . pretty_date($boss->end_at) : 'until the end of time' !!}.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm">
        </div>
    </div>
@endsection
