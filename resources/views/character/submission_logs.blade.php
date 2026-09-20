@extends('character.layout', ['isMyo' => $character->is_myo_slot])

<<<<<<< HEAD
@section('profile-title')
    {{ $character->fullName }}'s Submissions
@endsection

@section('meta-img')
    {{ $character->image->thumbnailUrl }}
@endsection

@section('profile-content')
    {!! breadcrumbs([
        $character->category->masterlist_sub_id ? $character->category->sublist->name . ' Masterlist' : 'Character masterlist' => $character->category->masterlist_sub_id ? 'sublist/' . $character->category->sublist->key : 'masterlist',
        $character->fullName => $character->url,
        'Submissions' => $character->url . '/submissions',
    ]) !!}

    @include('character._header', ['character' => $character])

    <h3>Submissions</h3>

    @if (count($logs))
        {!! $logs->render() !!}

        <div class="mb-4 logs-table">
            <div class="logs-table-header">
                <div class="row">
                    <div class="col-12 col-md-2">
                        <div class="logs-table-cell">Submitted By</div>
                    </div>
                    <div class="col-6 col-md-2">
                        <div class="logs-table-cell">Prompt</div>
                    </div>
                    <div class="col-6 col-md-4">
                        <div class="logs-table-cell">Link</div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="logs-table-cell">Date</div>
                    </div>
                </div>
            </div>
            <div class="logs-table-body">
                @foreach ($logs as $log)
                    <div class="logs-table-row">
                        <div class="row flex-wrap">
                            <div class="col-12 col-md-2">
                                <div class="logs-table-cell">
                                    {!! $log->user->displayName !!}
                                </div>
                            </div>
                            <div class="col-6 col-md-2">
                                <div class="logs-table-cell">
                                    {!! $log->prompt_id ? $log->prompt->displayName : '---' !!}
                                </div>
                            </div>
                            <div class="col-6 col-md-4">
                                <div class="logs-table-cell">
                                    <span class="ubt-texthide"><a href="{{ $log->url }}">{{ $log->url }}</a></span>
                                </div>
                            </div>
                            <div class="col-6 col-md-3">
                                <div class="logs-table-cell">
                                    {!! pretty_date($log->created_at) !!}
                                </div>
                            </div>
                            <div class="col-6 col-md-1">
                                <div class="logs-table-cell">
                                    <a href="{{ $log->viewUrl }}" class="btn btn-primary btn-sm py-0 px-1">Details</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {!! $logs->render() !!}
    @else
        <p>No submissions found.</p>
    @endif
=======
@section('profile-title') {{ $character->fullName }}'s Submissions @endsection

@section('meta-img') {{ $character->image->thumbnailUrl }} @endsection

@section('profile-content')
{!! breadcrumbs([($character->category->masterlist_sub_id ? $character->category->sublist->name.' Masterlist' : 'Character masterlist') => ($character->category->masterlist_sub_id ? 'sublist/'.$character->category->sublist->key : 'masterlist' ), $character->fullName => $character->url, 'Submissions' => $character->url.'/submissions']) !!}

@include('character._header', ['character' => $character])

<h3>Submissions</h3>

@if(count($logs))

{!! $logs->render() !!}

<div class="row ml-md-2">
  <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-bottom">
    <div class="col-12 col-md-2 font-weight-bold">Submitted By</div>
    <div class="col-6 col-md-2 font-weight-bold">Prompt</div>
    <div class="col-6 col-md-4 font-weight-bold">Link</div>
    <div class="col-6 col-md-3 font-weight-bold">Date</div>
  </div>

  @foreach($logs as $log)
    <div class="d-flex row flex-wrap col-12 mt-1 pt-1 px-0 ubt-top">
      <div class="col-12 col-md-2">{!! $log->user->displayName !!}</div>
      <div class="col-6 col-md-2">{!! $log->prompt_id ? $log->prompt->displayName : '---' !!}</div>
      <div class="col-6 col-md-4">
        <span class="ubt-texthide"><a href="{{ $log->url }}">{{ $log->url }}</a></span>
      </div>
      <div class="col-6 col-md-3">{!! pretty_date($log->created_at) !!}</div>
      <div class="col-6 col-md-1"><a href="{{ $log->viewUrl }}" class="btn btn-primary btn-sm py-0 px-1">Details</a></div>
    </div>
  @endforeach
</div>

{!! $logs->render() !!}

@else
    <p>No submissions found.</p>
@endif
>>>>>>> Cylunny/extension/polls-and-forms

@endsection
