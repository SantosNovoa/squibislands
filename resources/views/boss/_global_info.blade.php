<h3>Global Boss Information</h3>
<div class="row">
    <div class="col-lg-7">
        <div class="card mb-3">
            <div class="card-body">
                <h5>Leaderboard</h5>
                @include('boss._leaderboard', ['boss' => $boss])
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card mb-3">
            <div class="card-body">
                <h5>Your Damage</h5>
                @php
                    $userLogs = $boss->getLogs(Auth::user());
                    $userDamage = $userLogs->sum('damage');
                    $totalDamage = $boss->logs()->sum('damage');
                @endphp
                @if ($userLogs->isNotEmpty())
                    <p>
                        You have dealt {{ $userDamage }} damage to this boss.
                        @if ($userDamage > 0 && $totalDamage > 0)
                            <br />
                            That's {{ number_format(($userDamage / $totalDamage) * 100, 2) }}% of the total damage dealt to this boss!
                        @endif
                    </p>
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th width="80%">Attack Method</th>
                                <th width="20%">Damage</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($userLogs as $log)
                                <tr>
                                    <td>{{ $log->attackMethodDisplayName }} <span class="text-muted small">({{ $log->data['log'] }})</span></td>
                                    <td>{{ $log->damage }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="mb-0">You have not dealt any damage to this boss yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>
