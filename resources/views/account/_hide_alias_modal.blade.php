<<<<<<< HEAD
@if (!$alias)
=======
@if(!$alias)
>>>>>>> Cylunny/extension/polls-and-forms
    <p>Invalid alias selected.</p>
@elseif($alias->is_primary)
    <p>As this is your primary alias, you cannot hide it.</p>
@else
    <p>This will {{ !$alias->is_visible ? 'un' : '' }}hide the alias <strong>{!! $alias->displayAlias !!}</strong>. </p>
<<<<<<< HEAD
    @if ($alias->is_visible)
=======
    @if($alias->is_visible)
>>>>>>> Cylunny/extension/polls-and-forms
        <p>Logged-out users and logged-in users will not be able to see that this alias is associated with your account. Note that staff may be able to view your aliases regardless.</p>
    @else
        <p>Logged-out users and logged-in users will be able to view a list of your aliases from your profile page.</p>
    @endif
    {!! Form::open(['url' => 'account/hide-alias/' . $alias->id, 'class' => 'text-right']) !!}
<<<<<<< HEAD
    {!! Form::submit((!$alias->is_visible ? 'Unhide' : 'Hide') . ' Alias', ['class' => 'btn btn-secondary']) !!}
    {!! Form::close() !!}
@endif
=======
        {!! Form::submit((!$alias->is_visible ? 'Unhide' : 'Hide') . ' Alias', ['class' => 'btn btn-secondary']) !!}
    {!! Form::close() !!}
@endif
>>>>>>> Cylunny/extension/polls-and-forms
