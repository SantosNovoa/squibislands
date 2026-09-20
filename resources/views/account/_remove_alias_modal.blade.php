<<<<<<< HEAD
@if (!$alias)
=======
@if(!$alias)
>>>>>>> Cylunny/extension/polls-and-forms
    <p>Invalid alias selected.</p>
@elseif($alias->is_primary)
    <p>As this is your primary alias, you cannot remove it.</p>
@else
    <p>This will remove the alias <strong>{!! $alias->displayAlias !!}</strong> from your account. </p>
    <p>This will not affect characters that you own, and art/design credits credited to your {{ config('lorekeeper.settings.site_name', 'Lorekeeper') }} account will remain intact. Are you sure?</p>
    {!! Form::open(['url' => 'account/remove-alias/' . $alias->id, 'class' => 'text-right']) !!}
<<<<<<< HEAD
    {!! Form::submit('Remove Alias', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endif
=======
        {!! Form::submit('Remove Alias', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@endif
>>>>>>> Cylunny/extension/polls-and-forms
