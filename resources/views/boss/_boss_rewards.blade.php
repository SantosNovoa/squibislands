<table class="table table-sm">
    <thead>
        <tr>
            <th width="{{ isset($user) && $user ? '40%' : '60%' }}">Reward</th>
            <th width="20%">Amount</th>
            <th width="20%">
                Threshold
                {!! add_help('The threshold is the percentage damage the boss must have taken for this reward to be available.') !!}
            </th>
            @if (isset($user) && $user)
                <th width="20%">Claimed</th>
            @endif
        </tr>
    </thead>
    <tbody>
        @if (config('lorekeeper.boss_settings.show_rewards_before_threshold'))
            @foreach ($boss->rewards as $reward)
                <tr>
                    <td>{!! $reward->reward->displayName !!}</td>
                    <td>{{ $reward->quantity }}</td>
                    <td>{{ $reward->threshold ? $reward->threshold . '%' : 'Any' }}</td>
                    @if (isset($user) && $user)
                        <td>
                            @if ($boss->hasUserClaimedRewardsForThreshold($user, $reward->threshold))
                                <span class="text-success"><i class="fas fa-check"></i> Claimed</span>
                            @else
                                <span class="text-danger"><i class="fas fa-times"></i> Not Claimed</span>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        @else
            @php
                if ($boss->type == 'Global' || !Auth::check()) {
                    $damagePercentage = round((($boss->total_health - $boss->current_health) / $boss->total_health) * 100);
                } else {
                    $damagePercentage = round((($boss->total_health - $boss->getLogs(Auth::user())->sum('damage')) / $boss->total_health) * 100);
                }

                $rewards = $boss
                    ->rewards()
                    ->where(function ($query) use ($damagePercentage) {
                        $query->whereNull('threshold')->orWhere('threshold', '<=', $damagePercentage);
                    })
                    ->get()
                    ->sortBy('threshold');
            @endphp
            @foreach ($rewards as $reward)
                <tr>
                    <td>{!! $reward->reward->displayName !!}</td>
                    <td>{{ $reward->quantity }}</td>
                    <td>{{ $reward->threshold ? $reward->threshold . '%' : 'Any' }}</td>
                    @if (isset($user) && $user)
                        <td>
                            @if ($boss->hasUserClaimedRewardsForThreshold($user, $reward->threshold))
                                <span class="text-success"><i class="fas fa-check" data-toggle="tooltip" title="You have claimed this reward."></i></span>
                            @else
                                <span class="text-danger"><i class="fas fa-times" data-toggle="tooltip" title="You haven't claimed this reward yet."></i></span>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
