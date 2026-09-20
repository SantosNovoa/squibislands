<<<<<<< HEAD
@if ($gallery)
    {!! Form::open(['url' => 'admin/data/galleries/delete/' . $gallery->id]) !!}
=======
@if($gallery)
    {!! Form::open(['url' => 'admin/data/galleries/delete/'.$gallery->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the gallery <strong>{{ $gallery->name }}</strong>. This is not reversible. If submissions in this gallery exist, or this gallery has sub-galleries, you will not be able to delete this gallery.</p>
    <p>Are you sure you want to delete <strong>{{ $gallery->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Gallery', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid gallery selected.
@endif
=======
@else 
    Invalid gallery selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
