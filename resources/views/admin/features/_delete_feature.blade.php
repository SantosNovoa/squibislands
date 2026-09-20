<<<<<<< HEAD
@if ($feature)
    {!! Form::open(['url' => 'admin/data/traits/delete/' . $feature->id]) !!}
=======
@if($feature)
    {!! Form::open(['url' => 'admin/data/traits/delete/'.$feature->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the trait <strong>{{ $feature->name }}</strong>. This is not reversible. If characters possessing this trait exist, you will not be able to delete this trait.</p>
    <p>Are you sure you want to delete <strong>{{ $feature->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Trait', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid trait selected.
@endif
=======
@else 
    Invalid trait selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
