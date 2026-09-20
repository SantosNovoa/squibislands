<<<<<<< HEAD
@if ($currency)
    {!! Form::open(['url' => 'admin/data/currencies/delete/' . $currency->id]) !!}
=======
@if($currency)
    {!! Form::open(['url' => 'admin/data/currencies/delete/'.$currency->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the currency <strong>{{ $currency->name }}</strong>. This is not reversible. If users who possess this currency exist, their owned currency will also be deleted.</p>
    <p>Are you sure you want to delete <strong>{{ $currency->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Currency', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid currency selected.
@endif
=======
@else 
    Invalid currency selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
