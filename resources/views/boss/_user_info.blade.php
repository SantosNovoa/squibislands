<h3>User Boss Information</h3>
<div class="card">
    <div class="card-body">
        @if ($boss->getLogs(Auth::user())->isNotEmpty())
            <p class="mt-3">
                You have dealt {{ $boss->getLogs(Auth::user())->sum('damage') }} damage to this boss.
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
            <p class="mb-0">You have not dealt any damage to this boss yet.</p>
        @endif
    </div>
</div>
