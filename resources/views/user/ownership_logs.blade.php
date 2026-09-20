@extends('user.layout')

<<<<<<< HEAD
@section('profile-title')
    {{ $user->name }}'s Character History
@endsection

@section('profile-content')
    {!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Logs' => $user->url . '/ownership']) !!}

    <h1>
        {!! $user->displayName !!}'s Character History
    </h1>

    {!! $logs->render() !!}
    <div class="mb-4 logs-table">
        <div class="logs-table-header">
            <div class="row">
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Sender</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Recipient</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Character</div>
                </div>
                <div class="col-6 col-md-4">
                    <div class="logs-table-cell">Log</div>
                </div>
                <div class="col-6 col-md-2">
                    <div class="logs-table-cell">Date</div>
                </div>
            </div>
        </div>
        <div class="logs-table-body">
            @foreach ($logs as $log)
                <div class="logs-table-row">
                    @include('user._ownership_log_row', ['log' => $log, 'user' => $user, 'showCharacter' => true])
                </div>
            @endforeach
        </div>
    </div>
    {!! $logs->render() !!}
=======
@section('profile-title') {{ $user->name }}'s Character History @endsection

@section('profile-content')
{!! breadcrumbs(['Users' => 'users', $user->name => $user->url, 'Logs' => $user->url.'/ownership']) !!}

<h1>
    {!! $user->displayName !!}'s Character History
</h1>

{!! $logs->render() !!}
<div class="row ml-md-2 mb-4">
  <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-bottom">
    <div class="col-6 col-md-2 font-weight-bold">Sender</div>
    <div class="col-6 col-md-2 font-weight-bold">Recipient</div>
    <div class="col-6 col-md-2 font-weight-bold">Character</div>
    <div class="col-6 col-md-4 font-weight-bold">Log</div>
    <div class="col-6 col-md-2 font-weight-bold">Date</div>
  </div>
  @foreach($logs as $log)
      @include('user._ownership_log_row', ['log' => $log, 'user' => $user, 'showCharacter' => true])
  @endforeach
</div>
{!! $logs->render() !!}

>>>>>>> Cylunny/extension/polls-and-forms
@endsection
