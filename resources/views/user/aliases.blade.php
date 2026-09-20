@extends('user.layout')

<<<<<<< HEAD
@section('profile-title')
    {{ $user->name }}'s Aliases
@endsection

@section('profile-content')
    {!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Aliases' => $user->url . '/aliases']) !!}

    <h1>
        {!! $user->displayName !!}'s Aliases
    </h1>

    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-4">
                    <div class="logs-table-cell">Alias</div>
                </div>
                <div class="col-3">
                    <div class="logs-table-cell">Site</div>
                </div>
                <div class="col-5">
                    <div class="logs-table-cell"></div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($aliases as $alias)
                <div class="logs-table-row">
                    <div class="row flex-wrap">
                        <div class="col-4">
                            <div class="logs-table-cell">{!! $alias->displayAlias !!}</div>
                        </div>
                        <div class="col-3">
                            <div class="logs-table-cell"><i class="{{ $alias->config['icon'] }} fa-fw mr-1"></i> {{ $alias->config['full_name'] }}</div>
                        </div>
                        <div class="col-5">
                            <div class="logs-table-cell">
                                @if ($alias->is_primary_alias)
                                    <span class="badge badge-success">Primary</span>
                                @endif
                                @if (!$alias->is_visible)
                                    <i class="fas fa-eye-slash" data-toggle="tooltip" title="This alias is hidden from public view."></i>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
=======
@section('profile-title') {{ $user->name }}'s Aliases @endsection

@section('profile-content')
{!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Aliases' => $user->url.'/aliases']) !!}

<h1>
    {!! $user->displayName !!}'s Aliases
</h1>

<div class="row ml-md-2 mb-4">
    <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-bottom">
        <div class="col-4 font-weight-bold">Alias</div>
        <div class="col-3 font-weight-bold">Site</div>
        <div class="col-5 font-weight-bold"></div>
    </div>
    @foreach($aliases as $alias)
        <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-top">
            <div class="col-4">{!! $alias->displayAlias !!}</div>
            <div class="col-3"><i class="{{ $alias->config['icon'] }} fa-fw mr-1"></i> {{ $alias->config['full_name'] }}</div>
            <div class="col-5">
                @if($alias->is_primary_alias)<span class="badge badge-success">Primary</span>@endif
                @if(!$alias->is_visible) <i class="fas fa-eye-slash" data-toggle="tooltip" title="This alias is hidden from public view."></i> @endif
            </div>
        </div>
    @endforeach
</div>

>>>>>>> Cylunny/extension/polls-and-forms
@endsection
