@if ($raffle->is_active < 2)
    <div class="text-center">
        <p>This will roll {{ $raffle->winner_count }} winner(s) for the raffle <b>{{ $raffle->name }}</b>.</p>
<<<<<<< HEAD
        {!! Form::open(['url' => 'admin/raffles/roll/raffle/' . $raffle->id]) !!}
=======
        {!! Form::open(['url' => 'admin/raffles/roll/raffle/'.$raffle->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms
        {!! Form::submit('Roll!', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@else
    <div class="text-center">This raffle has already been completed.</div>
<<<<<<< HEAD
@endif
=======
@endif
>>>>>>> Cylunny/extension/polls-and-forms
