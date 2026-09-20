<<<<<<< HEAD
@if ($item)
    {!! Form::open(['url' => 'admin/data/items/delete/' . $item->id]) !!}
=======
@if($item)
    {!! Form::open(['url' => 'admin/data/items/delete/'.$item->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the item <strong>{{ $item->name }}</strong>. This is not reversible. If this item exists in at least one user's possession, you will not be able to delete this item.</p>
    <p>Are you sure you want to delete <strong>{{ $item->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Item', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid item selected.
@endif
=======
@else 
    Invalid item selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
