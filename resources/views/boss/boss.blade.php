@extends('layouts.app')

@section('title')
    Boss
@endsection

@section('content')
    {!! breadcrumbs(['Boss' => 'boss', $boss->displayName => 'boss/' . $boss->name]) !!}

    <div class="container col-lg-10 text-center">
        <div class="card">
            <div class="h1 card-header">
                <a href="{{ $boss->url }}">
                    @if ($boss->is_staff_only)
                        <i class="fas fa-crown mr-1" data-toggle="tooltip" title="Staff Only"></i>
                    @endif
                    {!! $boss->name !!}
                </a>
            </div>
            <div class="card-body">
                @if ($boss->has_image)
                    <img src="{{ $boss->getCurrentImage() }}" class="img-thumbnail mb-3" style="max-width: 250px; max-height: 250px;">
                @endif
                @if ($boss->type == 'User')
                    {!! $boss->healthBar(false, Auth::user()) !!}
                    <div class="alert alert-warning">
                        <i class="fas fa-user"></i> This boss is an individual challenge, with each user having their own battle.
                    </div>
                @else
                    {!! $boss->healthBar() !!}
                @endif
                @if ($boss->description)
                    <div class="card mb-3">
                        <div class="card-body">
                            {!! $boss->description !!}
                        </div>
                    </div>
                @endif
                @if (!$boss->isActive())
                    <div class="alert alert-secondary mt-3">
                        <i class="fas fa-exclamation-triangle"></i> This boss has {{ $boss->current_health < 1 ? 'been defeated' : 'been challenged' }} and is no longer active.
                        @if ($boss->end_at)
                            This boss was active until {!! pretty_date($boss->end_at) !!}.
                        @endif
                    </div>
                @endif
                <div class="row mb-3">
                    @if ($boss->current_health <= 0 && !$boss->can_attack_after_defeat)
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> This boss has been defeated and cannot be attacked again.
                            </div>
                        </div>
                    @else
                        <div class="col-md-3 d-flex">
                            <a class="btn btn-block btn-primary my-auto" data-toggle="collapse" href="#attack-methods" role="button" aria-expanded="false" aria-controls="attack-methods">
                                Challenge Boss
                            </a>
                        </div>
                    @endif
                    <div class="col-md-{{ $boss->current_health <= 0 && !$boss->can_attack_after_defeat ? '12' : '9' }}">
                        <h3>
                            Rewards
                            @if (!config('lorekeeper.boss_settings.show_rewards_before_threshold'))
                                {!! add_help('Some rewards may only be visble at certain health thresholds.') !!}
                            @endif
                        </h3>
                        @if (!count($boss->rewards))
                            No rewards.
                        @else
                            @include('boss._boss_rewards', ['boss' => $boss, 'user' => Auth::user()])
                            @if ($boss->allow_users_to_claim_rewards)
                                @if ($boss->is_rewards_only_for_participants && !$boss->hasUserParticipated(Auth::user()))
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-triangle"></i> You must participate in the battle to claim rewards.
                                    </div>
                                @else
                                    @if ($boss->hasUserClaimedRewards(Auth::user()))
                                        <div class="alert alert-success">
                                            <i class="fas fa-check"></i> You have already claimed all available rewards.
                                        </div>
                                    @else
                                        {!! Form::open(['url' => 'boss/' . $boss->id . '/claim']) !!}
                                        {!! Form::submit('Claim Rewards', ['class' => 'btn btn-primary btn-block col-md-8 mx-auto']) !!}
                                        {!! Form::close() !!}
                                    @endif
                                @endif
                            @endif
                        @endif
                    </div>
                </div>
                <div class="collapse" id="attack-methods">
                    @if ($boss->attack_methods && count($boss->attack_methods['methods']))
                        <h3>Attack Methods</h3>
                        @foreach ($boss->attack_methods['methods'] as $attackMethod)
                            <div class="text-left">
                                @include('boss._attack_method', ['attackMethod' => $attackMethod, 'boss' => $boss])
                            </div>
                        @endforeach
                    @else
                        <div class="alert alert-danger">No attack methods available.</div>
                    @endif
                </div>
                <hr />
                @include('boss._' . strtolower($boss->type) . '_info', ['boss' => $boss])
            </div>
        </div>
    </div>
@endsection
