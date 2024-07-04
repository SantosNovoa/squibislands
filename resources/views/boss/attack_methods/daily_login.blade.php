
@if (!$boss->getAttackMethodInformation('daily_login'))
    <div class="alert alert-danger">Attack method not available.</div>
@else
    @if (!$boss->getLogs(Auth::user(), 'daily_login')->first() || $boss->getLogs(Auth::user(), 'daily_login')->first()?->created_at?->diffInDays() > 0)
        {!! Form::open(['url' => 'boss/' . $boss->id . '/attack/' . $attackMethod]) !!}
            <div class="text-center">
                {!! Form::submit('Attack', ['class' => 'btn btn-primary btn-block btn-sm']) !!}
            </div>
        {!! Form::close() !!}
    @else
        <div class="alert alert-warning mb-0">You have already attacked this boss today.</div>
    @endif
@endif