@extends('layouts.app')

@section('title')
    Bosses
@endsection

@section('content')
    {!! breadcrumbs(['Boss' => 'boss']) !!}

    <h1>Current Boss{{ $bosses->count() == 1 ? '' : 'es' }}</h1>

    @if (!$bosses->count())
        <div class="alert alert-info">No current boss.</div>
    @else
        <div class="row justify-content-center">
            @foreach ($bosses as $boss)
                <div class="col-md-6 mb-4">
                    <div class="card text-center h-100">
                        <div class="card-header h3">
                            @if ($boss->is_staff_only)
                                <i class="fas fa-crown mr-1" data-toggle="tooltip" title="Staff Only"></i>
                            @endif
                            {!! $boss->displayName !!}
                        </div>
                        <div class="card-body">
                            @if ($boss->has_image)
                                <img src="{{ $boss->imageUrl }}" class="img-thumbnail mb-3" style="max-width: 250px; max-height: 250px;">
                            @endif
                            @if ($boss->type == 'User')
                                <div class="alert alert-warning">
                                    <i class="fas fa-user"></i> This boss is an individual challenge, with each user having their own battle.
                                </div>
                            @endif
                            <div class="progress h5">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($boss->current_health / $boss->total_health) * 100 }}%" aria-valuenow="{{ $boss->current_health }}"
                                    aria-valuemin="0" aria-valuemax="{{ $boss->total_health }}">
                                    {{ $boss->current_health }} / {{ $boss->total_health }}
                                </div>
                            </div>
                            <a class="btn btn-block btn-primary mt-3" href="{{ $boss->idUrl }}">View Boss</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
