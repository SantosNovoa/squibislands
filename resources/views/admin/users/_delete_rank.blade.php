<<<<<<< HEAD
@if ($rank)
    {!! Form::open(['url' => 'admin/users/ranks/delete/' . $rank->id]) !!}
=======
@if($rank)
    {!! Form::open(['url' => 'admin/users/ranks/delete/'.$rank->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the rank <strong>{{ $rank->name }}</strong>. This is not reversible and you will only be able to delete it if there are no users with this rank.</p>
    <p>Are you sure you want to delete <strong>{{ $rank->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Rank', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid rank selected.
@endif
=======
@else 
    Invalid rank selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
