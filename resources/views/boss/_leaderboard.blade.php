{{--
    Boss leaderboard. Shows the top N (leaderboard_limit) and hides the rest behind a "See all" toggle.
    Pass $leaderboard to override the list; defaults to every participant.
--}}
@php
    $leaderboard = $leaderboard ?? $boss->getLeaderboard(null, true);
    $totalDamage = $totalDamage ?? $boss->logs()->where('damage', '>', 0)->sum('damage');
    $visibleCount = config('lorekeeper.boss_settings.leaderboard_limit') ?: 5;
    $hiddenCount = max(0, $leaderboard->count() - $visibleCount);
    $medals = ['🥇', '🥈', '🥉'];
@endphp
@if ($leaderboard->isEmpty())
    <p>No users have challenged this boss yet.</p>
@else
    <div class="table-responsive">
        <table class="table table-sm mb-2">
            <thead>
                <tr>
                    <th width="10%">#</th>
                    <th>User</th>
                    <th class="text-right">Damage</th>
                    <th class="text-right">% of Total</th>
                    <th class="text-right">Attacks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($leaderboard->values() as $i => $entry)
                    <tr class="{{ $i >= $visibleCount ? 'boss-lb-extra-' . $boss->id . ' d-none' : '' }} {{ Auth::check() && Auth::user()->id == $entry->user_id ? 'font-weight-bold' : '' }}">
                        <td>{{ $medals[$i] ?? $i + 1 }}</td>
                        <td>{!! $entry->user ? $entry->user->displayName : '<span class="text-muted">Deleted User</span>' !!}</td>
                        <td class="text-right">{{ number_format($entry->total_damage) }}</td>
                        <td class="text-right">{{ $totalDamage > 0 ? number_format(($entry->total_damage / $totalDamage) * 100, 2) . '%' : '—' }}</td>
                        <td class="text-right">{{ $entry->attack_count }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @if ($hiddenCount)
        <button type="button" class="btn btn-sm btn-outline-secondary btn-block mb-2" data-see-all="See all {{ $leaderboard->count() }} participants"
            onclick="var rows = document.querySelectorAll('.boss-lb-extra-{{ $boss->id }}'); var show = rows[0].classList.contains('d-none'); rows.forEach(function (r) { r.classList.toggle('d-none', !show); }); this.textContent = show ? 'Show top {{ $visibleCount }} only' : this.dataset.seeAll;">See all {{ $leaderboard->count() }} participants</button>
    @endif
    <p class="text-muted small text-right mb-3">{{ $leaderboard->count() }} participant{{ $leaderboard->count() == 1 ? '' : 's' }} &middot; {{ number_format($totalDamage) }} total damage</p>
@endif
