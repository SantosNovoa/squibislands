@extends('layouts.app')

@section('title')
    Fetch Quests
@endsection

@section('content')
    @if ($fetches->count())
        <div class="row shops-row">
            @foreach ($fetches as $fetch)
                @include('fetchquests._fetch_entry', ['fetch' => $fetch])
            @endforeach
        </div>
    @else
        <div class="text-center my-5">
            <p class="mb-0">There are no fetch quests right now. Check back later!</p>
        </div>
    @endif
@endsection
