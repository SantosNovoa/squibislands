<<<<<<< HEAD
@if ($submission)
    <ul>
        @foreach ($favorites as $favorite)
            <li>{!! $favorite->user->displayName !!}</li>
        @endforeach
    </ul>
@else
    Invalid submission selected.
@endif
=======
@if($submission)
    <ul>
    @foreach($submission->favorites as $favorite)
        <li>{!! $favorite->user->displayName !!}</li>
    @endforeach
    </ul>
@else 
    Invalid submission selected.
@endif
>>>>>>> Cylunny/extension/polls-and-forms
