{{-- Displays a prompt's First Completion Bonus rewards. Expects $prompt; optional $showEligibility (checks the logged-in user). --}}
@if ($prompt->firstTimeRewards->count())
    <hr>
    <h4>First Completion Bonus</h4>
    <p class="mb-2">Granted in addition to the rewards above, the first time your submission to this prompt is approved.</p>
    @if (isset($showEligibility) && $showEligibility && Auth::check())
        @if ($prompt->hasBeenCompletedBy(Auth::user()))
            <div class="alert alert-secondary py-2">You've already completed this prompt, so the bonus no longer applies to you.</div>
        @else
            <div class="alert alert-success py-2">This would be your first completion of this prompt. You'll get the bonus below when it's approved!</div>
        @endif
    @endif
    <table class="table table-sm mb-0">
        <thead>
            <tr>
                <th width="70%">Bonus Reward</th>
                <th width="30%">Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($prompt->firstTimeRewards as $reward)
                <tr>
                    <td>{!! $reward->reward ? $reward->reward->displayName : $reward->rewardable_type !!}</td>
                    <td>{{ $reward->quantity }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
