@if ($group->is_active < 2)
    <div class="text-center">
        <p>This will roll all the raffles in the group <strong>{{ $group->name }}</strong>. Winners of raffles that come first will be excluded from later raffles.</p>
<<<<<<< HEAD
        {!! Form::open(['url' => 'admin/raffles/roll/group/' . $group->id]) !!}
=======
        {!! Form::open(['url' => 'admin/raffles/roll/group/'.$group->id]) !!}
>>>>>>> Cylunny/extension/polls-and-forms
        {!! Form::submit('Roll!', ['class' => 'btn btn-primary']) !!}
        {!! Form::close() !!}
    </div>
@else
    <div class="text-center">This set of raffles has already been completed.</div>
<<<<<<< HEAD
@endif
=======
@endif
>>>>>>> Cylunny/extension/polls-and-forms
