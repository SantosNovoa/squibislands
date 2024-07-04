<h3>Global Boss Information</h3>
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <h5 class="mt-3">Leaderboard</h5>
            @if ($boss->getLeaderboard()->isEmpty())
                <p>No users have challenged this boss yet.</p>
            @else
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th width="50%">Username</th>
                            <th width="50%">Total Damage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $medals = ['🥇', '🥈', '🥉'];
                            $medalIndex = 0;
                        @endphp
                        @foreach ($boss->getLeaderboard() as $user)
                            <tr>
                                <td>{!! $medalIndex < 3 ? $medals[$medalIndex++] : '' !!} {!! $user->user->displayName !!}</td>
                                <td>{{ $user->total_damage }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <h5 class="mt-3">Your Damage</h5>
            @if ($boss->getLogs(Auth::user())->isNotEmpty())
                <p>
                    You have dealt {{ $boss->getLogs(Auth::user())->sum('damage') }} damage to this boss.
                    <br />
                    That's {{ number_format(($boss->getLogs(Auth::user())->sum('damage') / $boss->logs()->sum('damage')) * 100, 2) }}% of the total damage dealt to this boss!
                </p>
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th width="80%">Attack Method</th>
                            <th width="20%">Damage</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($boss->getLogs(Auth::user()) as $log)
                            <tr>
                                <td>{{ $log->attackMethodDisplayName }} <span class="text-muted small">({{ $log->data['log'] }})</span></td>
                                <td>{{ $log->damage }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>You have not dealt any damage to this boss yet.</p>
            @endif
        </div>
    </div>
</div>
