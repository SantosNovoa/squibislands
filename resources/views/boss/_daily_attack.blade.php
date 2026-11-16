{{-- Featured daily attack button. Uses the boss's uploaded graphic if there is one. --}}
@if (Auth::check() && $boss->getAttackMethodInformation('daily_login'))
    @php
        $canDailyAttack = $boss->canDailyAttack(Auth::user());
    @endphp
    <div class="boss-daily-attack text-center mb-3">
        @if ($canDailyAttack)
            {!! Form::open(['url' => 'boss/' . $boss->id . '/attack/daily_login', 'onsubmit' => "this.querySelector('button').disabled = true;"]) !!}
            @if ($boss->dailyButtonImageUrl)
                <button type="submit" class="btn p-0 border-0 bg-transparent boss-daily-attack-btn" data-toggle="tooltip" title="Daily Attack!">
                    <img src="{{ $boss->dailyButtonImageUrl }}" class="img-fluid" alt="Daily Attack" />
                </button>
            @else
                <button type="submit" class="btn btn-danger btn-lg px-5 py-3 boss-daily-attack-btn">
                    <i class="fas fa-fist-raised mr-2"></i> Daily Attack!
                </button>
            @endif
            {!! Form::close() !!}
            <div class="small text-muted mt-1">Your free attack for today.</div>
        @else
            @if ($boss->dailyButtonImageUrl)
                <img src="{{ $boss->dailyButtonImageUrl }}" class="img-fluid boss-daily-attack-used" alt="Daily attack used" />
            @else
                <button type="button" class="btn btn-secondary btn-lg px-5 py-3" disabled>
                    <i class="fas fa-check mr-2"></i> Daily Attack Used
                </button>
            @endif
            <div class="small text-muted mt-1">You've already attacked today — come back tomorrow!</div>
        @endif
    </div>
    <style>
        .boss-daily-attack img { max-height: 200px; }
        .boss-daily-attack-btn img { transition: transform .15s ease; }
        .boss-daily-attack-btn:hover img, .boss-daily-attack-btn:focus img { transform: scale(1.05); }
        .boss-daily-attack-used { filter: grayscale(1); opacity: .5; }
    </style>
@endif
