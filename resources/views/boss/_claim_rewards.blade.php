{{-- Claim button / status. Used on both the battle page and the world page so it's reachable after defeat. --}}
@if (Auth::check() && $boss->allow_users_to_claim_rewards && count($boss->rewards))
    @if ($boss->is_rewards_only_for_participants && !$boss->hasUserParticipated(Auth::user()))
        <div class="alert alert-danger">
            <i class="fas fa-exclamation-triangle"></i> You must participate in the battle to claim rewards.
        </div>
    @elseif ($boss->hasUserClaimedRewards(Auth::user()))
        <div class="alert alert-success">
            <i class="fas fa-check"></i> You have already claimed all available rewards.
        </div>
    @else
        {!! Form::open(['url' => 'boss/' . $boss->id . '/claim']) !!}
        {!! Form::submit('Claim Rewards', ['class' => 'btn btn-primary btn-block col-md-8 mx-auto mb-3']) !!}
        {!! Form::close() !!}
    @endif
@endif
