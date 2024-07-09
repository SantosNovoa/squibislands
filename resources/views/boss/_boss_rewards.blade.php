<table class="table table-sm">
    <thead>
        <tr>
            <th width="60%">Reward</th>
            <th width="20%">Amount</th>
            <th width="20%">Threshold</th>
        </tr>
    </thead>
    <tbody>
        @if (config('lorekeeper.boss_settings.show_rewards_before_threshold'))
            @foreach ($boss->rewards as $reward)
                <tr>
                    <td>{!! $reward->reward->displayName !!}</td>
                    <td>{{ $reward->quantity }}</td>
                    <td>
                        {{ $reward->threshold ? $reward->threshold . '%' : 'Any' }}
                        {!! add_help('The threshold is the percentage damage the boss must have taken for this reward to be available.') !!}
                    </td>
                </tr>
            @endforeach
        @else
            @php
                $damagePercentage = (($boss->total_health - $boss->current_health) / $boss->total_health) * 100;

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
                </tr>
            @endforeach
        @endif
    </tbody>
</table>
