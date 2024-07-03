@extends('layouts.app')

@section('title')
    Boss
@endsection

@section('content')
    {!! breadcrumbs(['Boss' => 'boss', $boss->displayName => 'boss/' . $boss->name]) !!}

    <div class="container col-lg-8 text-center">
        <div class="card">
            <div class="h1 card-header">{!! $boss->displayName !!}</div>
            <div class="card-body">
                @if ($boss->has_image)
                    <img src="{{ $boss->getCurrentImage() }}" class="img-thumbnail mb-3" style="max-width: 250px; max-height: 250px;">
                @endif
                <div class="progress h5">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($boss->current_health / $boss->total_health) * 100 }}%" aria-valuenow="{{ $boss->current_health }}" aria-valuemin="0"
                        aria-valuemax="{{ $boss->total_health }}">
                        {{ $boss->current_health }} / {{ $boss->total_health }}
                    </div>
                </div>
                @if ($boss->description)
                    <div class="card mb-3">
                        <div class="card-body">
                            {!! $boss->description !!}
                        </div>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3 d-flex">
                        <a class="btn btn-block btn-primary my-auto" data-toggle="collapse" href="#attack-methods" role="button" aria-expanded="false" aria-controls="attack-methods">
                            Challenge Boss
                        </a>
                    </div>
                    <div class="col-md-9">
                        <h3>Rewards</h3>
                        @if (!count($boss->rewards))
                            No rewards.
                        @else
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th width="70%">Reward</th>
                                        <th width="30%">Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($boss->rewards as $reward)
                                        <tr>
                                            <td>{!! $reward->reward->displayName !!}</td>
                                            <td>{{ $reward->quantity }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
                <div class="collapse mt-3" id="attack-methods">
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
            </div>
        </div>
    </div>
@endsection
