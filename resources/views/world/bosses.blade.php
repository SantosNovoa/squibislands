@extends('world.layout')

@section('world-title')
    Bosses
@endsection

@section('content')
    {!! breadcrumbs(['World' => 'world', 'Bosses' => 'world/bosses']) !!}
    <h1>Bosses</h1>

    <h3>Current Boss{{ $currentBosses->count() == 1 ? '' : 'es' }}</h3>
    <div class="row justify-content-center">
        @foreach ($currentBosses as $currentBoss)
            <div class="col-md-5">
                <div class="card mb-3 h-100">
                    <div class="card-body">
                        @include('world._current_boss_entry', ['boss' => $currentBoss])
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <hr />

    <div>
        {!! Form::open(['method' => 'GET', 'class' => '']) !!}
        <div class="form-inline justify-content-end">
            <div class="form-group ml-3 mb-3">
                {!! Form::text('name', Request::get('name'), ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            </div>
        </div>
        <div class="form-inline justify-content-end">
            <div class="form-group ml-3 mb-3">
                {!! Form::select(
                    'sort',
                    [
                        'alpha' => 'Sort Alphabetically (A-Z)',
                        'alpha-reverse' => 'Sort Alphabetically (Z-A)',
                        'newest' => 'Newest First',
                        'oldest' => 'Oldest First',
                    ],
                    Request::get('sort') ?: 'alpha',
                    ['class' => 'form-control'],
                ) !!}
            </div>
            <div class="form-group ml-3 mb-3">
                {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    {!! $bosses->render() !!}
    @foreach ($bosses as $boss)
        <div class="card mb-3">
            <div class="card-body">
                @include('world._boss_entry', ['boss' => $boss])
            </div>
        </div>
    @endforeach
    {!! $bosses->render() !!}

    <div class="text-center mt-4 small text-muted">{{ $bosses->total() }} result{{ $bosses->total() == 1 ? '' : 's' }} found.</div>
@endsection
