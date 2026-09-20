<<<<<<< HEAD
@if ($shop)
    {!! Form::open(['url' => 'admin/data/shops/delete/' . $shop->id]) !!}
=======
@if($shop)
    {!! Form::open(['url' => 'admin/data/shops/delete/'.$shop->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the shop <strong>{{ $shop->name }}</strong>. This is not reversible. If you would like to hide the shop from users, you can set it as inactive from the shop settings page.</p>
    <p>Are you sure you want to delete <strong>{{ $shop->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Shop', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid shop selected.
@endif
=======
@else 
    Invalid shop selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
