@extends('admin.layout')

@section('admin-title')
    Bosses
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'Bosses' => 'admin/data/bosses']) !!}

    <h1>Bosses</h1>

    <p>
        This page lists all the bosses in the game. You can create new bosses, edit existing ones, and search for bosses by name.
    </p>

    <div class="text-right mb-3">
        <a class="btn btn-primary" href="{{ url('admin/data/bosses/create') }}"><i class="fas fa-plus"></i> Create New Boss</a>
    </div>

    <div>
        {!! Form::open(['method' => 'GET', 'class' => 'form-inline justify-content-end']) !!}
        <div class="form-group mr-3 mb-3">
            {!! Form::text('name', Request::get('name'), ['class' => 'form-control', 'placeholder' => 'Name']) !!}
        </div>
        <div class="form-group mb-3">
            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

    @if (!count($bosses))
        <p>No bosses found.</p>
    @else
        {!! $bosses->render() !!}
        <div class="mb-4 logs-table">
            <div class="logs-table-header">
                <div class="row">
                    <div class="col-11 col-md-11">
                        <div class="logs-table-cell">Name</div>
                    </div>
                </div>
            </div>
            <div class="logs-table-body">
                @foreach ($bosses as $boss)
                    <div class="logs-table-row">
                        <div class="row flex-wrap">
                            <div class="col-11 col-md-11">
                                <div class="logs-table-cell">
                                    @if (!$boss->is_active)
                                        <i class="fas fa-eye-slash mr-1"></i>
                                    @endif
                                    @if ($boss->is_staff_only)
                                        <i class="fas fa-crown mr-1"></i>
                                    @endif
                                    {!! $boss->displayName !!}
                                </div>
                            </div>
                            <div class="col-3 col-md-1 text-right">
                                <div class="logs-table-cell">
                                    <a href="{{ url('admin/data/bosses/edit/' . $boss->id) }}" class="btn btn-primary py-0 px-2">Edit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {!! $bosses->render() !!}
    @endif
@endsection
