@extends('layouts.app')

@section('title')
    Boss
@endsection

@section('content')
    {!! breadcrumbs(['Boss' => 'boss', $boss->displayName => 'boss/' . $boss->name]) !!}

    @php
        $attackMethods = $boss->attack_methods['methods'] ?? [];
        // daily attack is featured on its own, so keep it out of the collapsed list
        $otherAttackMethods = array_values(array_diff($attackMethods, ['daily_login']));
        $canAttack = $boss->isActive();
        $showChallenge = $canAttack && count($otherAttackMethods);
        // per-user bosses don't track current_health, so only global bosses can be "defeated" here
        $isDefeated = $boss->type == 'Global' && $boss->current_health <= 0 && !$boss->can_attack_after_defeat;
    @endphp

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
                <div class="boss-img-container w-100 d-flex justify-content-center">
                    <img src="{{ $boss->getCurrentImage() }}" class="img-thumbnail mb-3 img-fluid">
                </div>
                @endif
                @if ($boss->type == 'User')
                    {!! $boss->healthBar(false, Auth::user() ?? null) !!}
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
                @if ($canAttack && in_array('daily_login', $attackMethods))
                    @include('boss._daily_attack', ['boss' => $boss])
                @endif
                <div class="row mb-3">
                    @if ($isDefeated)
                        <div class="col-md-12">
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-triangle"></i> This boss has been defeated and cannot be attacked again.
                            </div>
                        </div>
                    @elseif ($showChallenge)
                        <div class="col-md-3 d-flex">
                            <a class="btn btn-block btn-primary my-auto" data-toggle="collapse" href="#attack-methods" role="button" aria-expanded="false" aria-controls="attack-methods">
                                Challenge Boss
                            </a>
                        </div>
                    @endif
                    <div class="col-md-{{ $showChallenge && !$isDefeated ? '9' : '12' }}">
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
                            @include('boss._claim_rewards', ['boss' => $boss])
                        @endif
                    </div>
                </div>
                <div class="collapse" id="attack-methods">
                    @if (count($otherAttackMethods))
                        <h3>Attack Methods</h3>
                        @foreach ($otherAttackMethods as $attackMethod)
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
