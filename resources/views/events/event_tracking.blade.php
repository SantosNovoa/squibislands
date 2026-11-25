@extends('layouts.app')

@section('title')
    Event Tracking
@endsection

@section('content')
    {!! breadcrumbs(['Event Tracking' => 'event-tracking']) !!}
    <h1>Event Tracking</h1>

    @if ($page)
        <div class="site-page-content parsed-text">
            {!! $page->parsed_text !!}
        </div>
    @endif

    @if ($currency)
        @if (Settings::get('event_global_score') && Settings::get('event_global_goal') != 0)
            <div class="progress mb-2" style="height: 2em;">
                <div class="progress-bar bg-success" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
                    @if ($total && $total->quantity > 0)
                        <h5 class="align-self-center my-2">{{ $total->quantity }}/{{ Settings::get('event_global_goal') }}</h5>
                    @endif
                </div>
            </div>
        @endif
        @if (Settings::get('event_global_score'))
            <p class="text-center">
                The current event currency is {{ $currency->name }}, and the current global total is {!! $currency->display($total ? $total->quantity : 0) !!}{{ Settings::get('event_global_goal') != 0 ? '.' : '!' }}
                @if (Settings::get('event_global_goal') != 0)
                    The current overall goal is {!! $currency->display(Settings::get('event_global_goal')) !!}!
                @endif
            </p>
        @endif

        @if (Settings::get('event_teams'))
            @if ($teams->count())
                @if (Auth::check() && !isset(Auth::user()->settings->team_id))
                    <p class="text-center">
                        It seems you haven't selected a team yet! You can choose one of the teams here-- but choose carefully, as your decision is final!
                    </p>
                @endif

                @if (Settings::get('event_weighting'))
                    <p class="text-center">
                        Note that the team scores displayed here are <strong>weighted</strong> based on the number of members each team has!
                    </p>
                @endif

                <div class="row">
                    @foreach ($teams as $team)
                        {!! $loop->remaining + 1 == $loop->count % 3 ? '<div class="my-auto col mobile-hide"></div>' : '' !!}
                        <div class="col-md-4 mb-3 text-center">
                            @if ($team->has_image)
                                <img src="{{ $team->imageUrl }}" class="mw-100" alt="{{ $team->name }}" />
                            @endif
                            <h3>{{ $team->name }}</h3>
                            <p>
                                Members: {{ $team->members->count() }} ・
                                Score: {{ $team->weightedScore }}
                            </p>
                            @if (Auth::check() && !isset(Auth::user()->settings->team_id))
                                {!! Form::open(['url' => 'event-tracking/team/' . $team->id]) !!}
                                {!! Form::submit('Join Team', ['class' => 'btn btn-primary']) !!}
                                {!! Form::close() !!}
                            @elseif (Auth::check() && Auth::user()->settings->team_id == $team->id)
                                <p><strong>This is your team!</strong></p>
                            @endif
                        </div>
                        {!! $loop->count % 3 != 0 && $loop->last ? '<div class="my-auto col mobile-hide"></div>' : '' !!}
                        {!! $loop->iteration % 3 == 0 ? '<div class="w-100"></div>' : '' !!}
                    @endforeach
                </div>
            @else
                <p class="text-center">No teams have been set up yet.</p>
            @endif
        @endif
    @else
        <p>Oh no! It seems there's no event currency.</p>
    @endif
@endsection
