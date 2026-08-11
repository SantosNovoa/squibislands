@extends('expeditions.layout')

@section('expeditions-title')
    My Expeditions
@endsection

@section('expeditions-content')
    {!! breadcrumbs(['Expeditions' => 'expeditions', 'My Expeditions' => 'expeditions/my']) !!}

    <h1>My Expeditions</h1>

    @if (!count($logs))
        <p>You haven't sent any characters on an expedition yet.</p>
    @else
        <table class="table table-sm">
            <thead>
                <tr>
                    <th>Expedition</th>
                    <th>Characters</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($logs as $log)
                    <tr>
                        <td>{{ $log->expedition->name }}</td>
                        <td>{{ $log->characters->pluck('slug')->implode(', ') }}</td>
                        <td>
                            @if (!$log->is_processed)
                                In progress &mdash; returns {{ $log->completes_at->diffForHumans() }}
                            @elseif($log->is_claimed)
                                @if ($log->success)
                                    <span class="text-success">Success (Claimed)</span>
                                @else
                                    <span class="text-danger">Failed (Claimed)</span>
                                @endif
                            @else
                                @if ($log->success)
                                    <span class="text-success">Success &mdash; ready to claim!</span>
                                @else
                                    <span class="text-danger">Failed</span>
                                @endif
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ $log->expedition->url }}" class="btn btn-outline-primary btn-sm">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
