@extends('prompts.layout')

@section('title')
    {{ $prompt->name }}
@endsection

@section('content')
    {!! breadcrumbs(['Prompts' => 'prompts', 'All Prompts' => 'prompts/prompts', $prompt->name => 'prompts/' . $prompt->id]) !!}
    @if ($prompt->parent_id && $prompt->parent && !$prompt->is_details_visible && !$prompt->isUnlockedFor(Auth::user()) && !(Auth::check() && Auth::user()->isStaff))
        @include('prompts._prompt_denied_entry', ['prompt' => $prompt])
    @else
        @include('prompts._prompt_entry', ['prompt' => $prompt, 'isPage' => true])
    @endif
@endsection
