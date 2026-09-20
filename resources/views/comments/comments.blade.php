@php
    if (isset($approved) and $approved == true) {
<<<<<<< HEAD
        if (isset($type) && $type != null) {
            $comments = $model->approvedComments->where('type', $type);
        } else {
            $comments = $model->approvedComments->where('type', 'User-User');
        }
    } else {
        if (isset($type) && $type != null) {
            $comments = $model->commentz->where('type', $type);
        } else {
            $comments = $model->commentz->where('type', 'User-User');
        }
    }

    $theme = Auth::user()->theme ?? (App\Models\Theme::where('is_default', true)->first() ?? null);
    $conditionalTheme = null;
    if (class_exists('\App\Models\Weather\WeatherSeason')) {
        $conditionalTheme =
            App\Models\Theme::where('link_type', 'season')
                ->where('link_id', Settings::get('site_season'))
                ->first() ??
            (App\Models\Theme::where('link_type', 'weather')
                ->where('link_id', Settings::get('site_weather'))
                ->first() ??
                $theme);
    }

    $decoratorTheme = Auth::user()->decoratorTheme ?? null;
@endphp

@if (!isset($type) || $type == 'User-User')
    <h2>Comments</h2>
=======
        if(isset($type) && $type != null) $comments = $model->approvedComments->where('type', $type);
        else $comments = $model->approvedComments->where('type', "User-User");
    } else {
        if(isset($type) && $type != null) $comments = $model->commentz->where('type', $type);
        else $comments = $model->commentz->where('type', "User-User");
    }
@endphp

@if($comments->count() < 1)
    <div class="alert alert-warning">There are no comments yet.</div>
@endif

@if(!isset($type) || $type == "User-User")
<h2>Comments</h2>
>>>>>>> Cylunny/extension/polls-and-forms
@endif
<div class="d-flex mw-100 row mx-0" style="overflow:hidden;">
    @php
        $comments = $comments->sortByDesc('created_at');

        if (isset($perPage)) {
            $page = request()->query('page', 1) - 1;

            $parentComments = $comments->where('child_id', '');

            $slicedParentComments = $parentComments->slice($page * $perPage, $perPage);

<<<<<<< HEAD
            $m = config('comments.model'); // This has to be done like this, otherwise it will complain.
            $modelKeyName = (new $m())->getKeyName(); // This defaults to 'id' if not changed.
=======
            $m = Config::get('comments.model'); // This has to be done like this, otherwise it will complain.
            $modelKeyName = (new $m)->getKeyName(); // This defaults to 'id' if not changed.
>>>>>>> Cylunny/extension/polls-and-forms

            $slicedParentCommentsIds = $slicedParentComments->pluck($modelKeyName)->toArray();

            // Remove parent Comments from comments.
            $comments = $comments->where('child_id', '!=', '');

<<<<<<< HEAD
            $grouped_comments = new \Illuminate\Pagination\LengthAwarePaginator($slicedParentComments->merge($comments)->groupBy('child_id'), $parentComments->count(), $perPage);
=======
            $grouped_comments = new \Illuminate\Pagination\LengthAwarePaginator(
                $slicedParentComments->merge($comments)->groupBy('child_id'),
                $parentComments->count(),
                $perPage
            );
>>>>>>> Cylunny/extension/polls-and-forms

            $grouped_comments->withPath(request()->url());
        } else {
            $grouped_comments = $comments->groupBy('child_id');
        }
    @endphp
<<<<<<< HEAD
    @foreach ($grouped_comments as $comment_id => $comments)
        {{-- Process parent nodes --}}
        @if ($comment_id == '')
            @foreach ($comments as $comment)
=======
    @foreach($grouped_comments as $comment_id => $comments)
        {{-- Process parent nodes --}}
        @if($comment_id == '')
            @foreach($comments as $comment)
>>>>>>> Cylunny/extension/polls-and-forms
                @include('comments::_comment', [
                    'comment' => $comment,
                    'grouped_comments' => $grouped_comments,
                    'limit' => 0,
<<<<<<< HEAD
                    'compact' => $comment->type == 'Staff-Staff' ? true : false,
                    'allow_dislikes' => isset($allow_dislikes) ? $allow_dislikes : false,
=======
                    'compact' => ($comment->type == "Staff-Staff") ? true : false,
>>>>>>> Cylunny/extension/polls-and-forms
                ])
            @endforeach
        @endif
    @endforeach
</div>

<<<<<<< HEAD
@if ($comments->count() < 1)
    <div class="alert alert-warning">There are no comments yet.</div>
@endif

@isset($perPage)
    <div class="ml-auto mt-2">{{ $grouped_comments->links() }}</div>
@endisset

@auth
    @include('comments._form', [
        'compact' => isset($type) && $type == 'Staff-Staff' && config('lorekeeper.settings.wysiwyg_comments') ? true : false,
    ])
@else
    <div class="card mt-3">
=======
@isset ($perPage)
    {{ $grouped_comments->links() }}
@endisset

<br><br><br>
@auth
    @include('comments._form')
@else
    <div class="card">
>>>>>>> Cylunny/extension/polls-and-forms
        <div class="card-body">
            <h5 class="card-title">Authentication required</h5>
            <p class="card-text">You must log in to post a comment.</p>
            <a href="{{ route('login') }}" class="btn btn-primary">Log in</a>
        </div>
    </div>
@endauth
<<<<<<< HEAD

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            tinymce.init({
                selector: '.comment-wysiwyg',
                height: 250,
                menubar: false,
                convert_urls: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen spoiler',
                    'insertdatetime media table paste code help wordcount'
                ],
                toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | spoiler-add spoiler-remove | removeformat | code',
                content_css: [
                    'https://fonts.googleapis.com/css2?family=Cherry+Bomb+One&family=DynaPuff:wdth,wght@75..100,400..700&family=Lato:wght@400;700&family=Roboto+Condensed:wght@400;700&display=swap',
                    '{{ asset('css/app.css') }}',
                    '{{ asset('css/lorekeeper.css?v=' . filemtime(public_path('css/lorekeeper.css'))) }}',
                    {!! file_exists(public_path() . '/css/custom.css') ? "'" . asset('css/custom.css?v=') . filemtime(public_path('css/custom.css')) . "'," : '' !!}
                    {!! $theme?->cssUrl ? "'" . asset($theme?->cssUrl) . "'," : '' !!}
                    {!! $conditionalTheme?->cssUrl ? "'" . asset($conditionalTheme?->cssUrl) . "'," : '' !!}
                    {!! $decoratorTheme?->cssUrl ? "'" . asset($decoratorTheme?->cssUrl) . "'," : '' !!} '{{ asset('css/all.min.css') }}' //fontawesome
                ],
                content_style: `
                    {!! str_replace(['<style>', '</style>'], '', view('layouts.editable_theme', ['theme' => $theme])) !!}
                    {!! isset($conditionalTheme) && $conditionalTheme ? str_replace(['<style>', '</style>'], '', view('layouts.editable_theme', ['theme' => $conditionalTheme])) : '' !!}
                    {!! isset($decoratorTheme) && $decoratorTheme ? str_replace(['<style>', '</style>'], '', view('layouts.editable_theme', ['theme' => $decoratorTheme])) : '' !!}
                `,
                spoiler_caption: 'Toggle Spoiler',
                target_list: false
            });
        });
    </script>
@endsection
=======
>>>>>>> Cylunny/extension/polls-and-forms
