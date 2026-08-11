@extends('expeditions.layout')

@section('expeditions-title')
    Expeditions
@endsection

@section('expeditions-content')
    {!! breadcrumbs(['Expeditions' => 'expeditions']) !!}

    <h1>Expeditions</h1>

    <div class="container">
        @foreach ($expeditions as $expedition)
            @if ($expedition->has_image)
                <div class="expedition-container d-flex flex-column pb-3">
                    <a href="{{ $expedition->url }}">
                        <img src="{{ $expedition->expeditionImageUrl }}" style="max-height: 180px; border-radius: 5px 5px 0 0;" class="expedition-img card-img-top" alt="{{ $expedition->name }}">
                    </a>
            @endif
            <div class="expedition-title-container">
                <a href="{{ $expedition->url }}" class="h5 mb-0">
                    {{ $expedition->name }}
                </a>
            </div>
            <div class="expedition-info-container d-flex justify-content-between" style="font-family: CherryBombOne, serif;">
                <div class="expedition-left-side">
                    <span>Possible Rewards: </span>
                    @foreach ($expedition->rewards as $reward)
                        @if ($reward->rewardable->has_icon)
                            <span>
                                <img src="{{ $reward->rewardable->currencyIconUrl }}" alt="{{ $reward->rewardable->name }}">
                            </span>
                        @endif
                        @if ($reward->rewardable->has_image)
                            <span>
                                <img src="{{ $reward->rewardable->imageUrl }}" style="max-height: 20px;"alt="{{ $reward->rewardable->name }}">
                            </span>
                        @endif
                        <span>{{ $reward->quantity }}</span>
                        <span>{{ $reward->rewardable->name }}</span>
                    @endforeach
                </div>

                <div class="expedition-right-side">
                    @auth
                        @foreach ($expedition->logs as $log)
                            @if (!$log->is_processed && $log->user_id == Auth::user()->id)
                                <div class="expedition-log-container">
                                    <span>{{ $log->completes_at->diffForHumans(['parts' => 2]) }}</span>
                                </div>
                            @endif
                        @endforeach
                    @endauth
                </div>
            </div>
    </div>
    @endforeach
    </div>
@endsection
