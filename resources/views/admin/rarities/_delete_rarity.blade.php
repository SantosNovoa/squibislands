<<<<<<< HEAD
@if ($rarity)
    {!! Form::open(['url' => 'admin/data/rarities/delete/' . $rarity->id]) !!}
=======
@if($rarity)
    {!! Form::open(['url' => 'admin/data/rarities/delete/'.$rarity->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms

    <p>You are about to delete the rarity <strong>{{ $rarity->name }}</strong>. This is not reversible. If traits and/or characters that have this rarity exist, you will not be able to delete this rarity.</p>
    <p>Are you sure you want to delete <strong>{{ $rarity->name }}</strong>?</p>

    <div class="text-right">
        {!! Form::submit('Delete Rarity', ['class' => 'btn btn-danger']) !!}
    </div>

    {!! Form::close() !!}
<<<<<<< HEAD
@else
    Invalid rarity selected.
@endif
=======
@else 
    Invalid rarity selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
