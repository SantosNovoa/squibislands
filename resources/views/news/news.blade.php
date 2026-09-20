<<<<<<< HEAD
@extends('news.layout')

@section('news-title')
    {{ $news->title }}
@endsection

@section('news-content')
    {!! breadcrumbs(['Site News' => 'news', $news->title => $news->url]) !!}
    @include('news._news', ['news' => $news, 'page' => true])
    <hr class="mb-5" />

    @comments(['model' => $news, 'perPage' => 5])
@endsection
=======
@extends('layouts.app')

@section('title') {{ $news->title }} @endsection

@section('content')
    {!! breadcrumbs(['Site News' => 'news', $news->title => $news->url]) !!}
    @include('news._news', ['news' => $news, 'page' => TRUE])
<hr>
<br><br>

@comments(['model' => $news,
        'perPage' => 5
    ])

@endsection
    
>>>>>>> Cylunny/extension/polls-and-forms
