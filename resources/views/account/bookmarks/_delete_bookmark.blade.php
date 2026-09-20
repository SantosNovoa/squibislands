<p>You are about to delete your bookmark for {!! $bookmark->character->displayName !!}. Are you sure?</p>
<div class="text-right">
<<<<<<< HEAD
    {!! Form::open(['url' => 'account/bookmarks/delete/' . $bookmark->id]) !!}
    {!! Form::submit('Delete Bookmark', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
</div>
=======
    {!! Form::open(['url' => 'account/bookmarks/delete/'.$bookmark->id]) !!}
        {!! Form::submit('Delete Bookmark', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
</div>
>>>>>>> Cylunny/extension/polls-and-forms
