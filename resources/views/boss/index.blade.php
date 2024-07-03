@extends('layouts.app')

@section('title')
    Bosses
@endsection

@section('content')
    {!! breadcrumbs(['Boss' => 'boss']) !!}

    <h1>Current Boss</h1>

    @if (!$bosses->count())
        <div class="alert alert-info">No current boss.</div>
    @else
        <div class="row justify-content-center">
            @foreach ($bosses as $boss)
                <div class="col-md-6">
                    <div class="card mb-3 text-center">
                        <div class="card-header h3">
                            {!! $boss->displayName !!}
                        </div>
                        <div class="card-body">
                            @if ($boss->has_image)
                                <img src="{{ $boss->imageUrl }}" class="img-thumbnail mb-3" style="max-width: 250px; max-height: 250px;">
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
