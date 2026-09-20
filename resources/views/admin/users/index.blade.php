@extends('admin.layout')

<<<<<<< HEAD
@section('admin-title')
    User Index
@endsection

@section('admin-content')
    {!! breadcrumbs(['Admin Panel' => 'admin', 'User Index' => 'admin/users']) !!}

    <h1>User Index</h1>

    <p>Click on a user's name to view/edit their information.</p>

    <div>
        {!! Form::open(['method' => 'GET', 'class' => 'form-inline justify-content-end']) !!}
=======
@section('admin-title') User Index @stop

@section('admin-content')
{!! breadcrumbs(['Admin Panel' => 'admin', 'User Index' => 'admin/users']) !!}

<h1>User Index</h1>

<p>Click on a user's name to view/edit their information.</p>

<div>
    {!! Form::open(['method' => 'GET', 'class' => 'form-inline justify-content-end']) !!}
>>>>>>> Cylunny/extension/polls-and-forms
        <div class="form-group mr-sm-3 mb-3">
            {!! Form::text('name', Request::get('name'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group mr-sm-3 mb-3">
            {!! Form::select('rank_id', $ranks, Request::get('rank_id'), ['class' => 'form-control']) !!}
        </div>
        <div class="form-group mr-3 mb-3">
<<<<<<< HEAD
            {!! Form::select(
                'sort',
                [
                    'alpha' => 'Sort Alphabetically (A-Z)',
                    'alpha-reverse' => 'Sort Alphabetically (Z-A)',
                    'alias' => 'Sort by Alias (A-Z)',
                    'alias-reverse' => 'Sort by Alias (Z-A)',
                    'rank' => 'Sort by Rank (Default)',
                    'newest' => 'Newest First',
                    'oldest' => 'Oldest First',
                ],
                Request::get('sort') ?: 'category',
                ['class' => 'form-control'],
            ) !!}
=======
            {!! Form::select('sort', [
                'alpha'          => 'Sort Alphabetically (A-Z)',
                'alpha-reverse'  => 'Sort Alphabetically (Z-A)',
                'alias'          => 'Sort by Alias (A-Z)',
                'alias-reverse'  => 'Sort by Alias (Z-A)',
                'rank'           => 'Sort by Rank (Default)',
                'newest'         => 'Newest First',
                'oldest'         => 'Oldest First'
            ], Request::get('sort') ? : 'category', ['class' => 'form-control']) !!}
>>>>>>> Cylunny/extension/polls-and-forms
        </div>
        <div class="form-group mb-3">
            {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
        </div>
<<<<<<< HEAD
        {!! Form::close() !!}
    </div>

    {!! $users->render() !!}
    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-12 col-md-4">
                    <div class="logs-table-cell">Username</div>
                </div>
                <div class="col-4 col-md-3">
                    <div class="logs-table-cell">Alias</div>
                </div>
                <div class="col-4 col-md-2">
                    <div class="logs-table-cell">Rank</div>
                </div>
                <div class="col-4 col-md-3">
                    <div class="logs-table-cell">Joined</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($users as $user)
                <div class="logs-table-row">
                    <div class="row flex-wrap">
                        <div class="col-12 col-md-4 ">
                            <div class="logs-table-cell"><a href="{{ $user->adminUrl }}">{!! $user->is_banned ? '<strike>' : '' !!}{{ $user->name }}{!! $user->is_banned ? '</strike>' : '' !!}</a></div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="logs-table-cell">{!! $user->displayAlias !!}</div>
                        </div>
                        <div class="col-4 col-md-2">
                            <div class="logs-table-cell">{!! $user->rank->displayName !!}</div>
                        </div>
                        <div class="col-4 col-md-3">
                            <div class="logs-table-cell">{!! pretty_date($user->created_at) !!}</div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {!! $users->render() !!}

    <div class="text-center mt-4 small text-muted">{{ $count }} user{{ $count == 1 ? '' : 's' }} found.</div>
=======
    {!! Form::close() !!}
</div>

{!! $users->render() !!}
  <div class="row ml-md-2">
    <div class="d-flex row flex-wrap col-12 pb-1 px-0 ubt-bottom">
      <div class="col-12 col-md-4 font-weight-bold">Username</div>
      <div class="col-4 col-md-3 font-weight-bold">Alias</div>
      <div class="col-4 col-md-2 font-weight-bold">Rank</div>
      <div class="col-4 col-md-3 font-weight-bold">Joined</div>
    </div>
    @foreach($users as $user)
    <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-top">
      <div class="col-12 col-md-4 "><a href="{{ $user->adminUrl }}">{!! $user->is_banned ? '<strike>' : '' !!}{{ $user->name }}{!! $user->is_banned ? '</strike>' : '' !!}</a></div>
      <div class="col-4 col-md-3">{!! $user->displayAlias !!}</div>
      <div class="col-4 col-md-2">{!! $user->rank->displayName !!}</div>
      <div class="col-4 col-md-3">{!! pretty_date($user->created_at) !!}</div>
    </div>
    @endforeach
  </div>
{!! $users->render() !!}

<div class="text-center mt-4 small text-muted">{{ $count }} user{{ $count == 1 ? '' : 's' }} found.</div>

>>>>>>> Cylunny/extension/polls-and-forms
@endsection
