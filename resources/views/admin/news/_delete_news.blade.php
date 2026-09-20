<<<<<<< HEAD
@if ($news)
    {!! Form::open(['url' => 'admin/news/delete/' . $news->id]) !!}

    <p>You are about to delete the news post <strong>{{ $news->title }}</strong>. This is not reversible. If you would like to preserve the content while preventing users from accessing the post, you can use the viewable setting instead to hide the
        post.</p>
=======
@if($news)
    {!! Form::open(['url' => 'admin/news/delete/'.$news->id]) !!}

    <p>You are about to delete the news post <strong>{{ $news->title }}</strong>. This is not reversible. If you would like to preserve the content while preventing users from accessing the post, you can use the viewable setting instead to hide the post.</p>
>>>>>>> Cylunny/extension/polls-and-forms
    <p>Are you sure you want to delete <strong>{{ $news->title }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid post selected.
@endif
=======
@else 
    Invalid post selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
