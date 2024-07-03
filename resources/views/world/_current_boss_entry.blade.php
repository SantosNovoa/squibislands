<div class="row world-entry">
    @if ($boss->has_image)
        <div class="mx-auto">
            <a href="{{ $boss->getCurrentImage() }}" class="" data-lightbox="entry" data-title="{{ $boss->name }}">
                <img src="{{ $boss->getCurrentImage() }}" class="world-entry-image" alt="{{ $boss->name }}" style="max-width: 250px; max-height: 250px;" />
            </a>
        </div>
    @endif
    <div class="col-12">
        <x-admin-edit title="Boss" :object="$boss" />
        <h3 class="text-center">
            @if (!$boss->is_active)
                <i class="fas fa-eye-slash mr-1"></i>
            @endif
            {!! $boss->name !!}
        </h3>
        <div class="progress h5">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: {{ ($boss->current_health / $boss->total_health) * 100 }}%" aria-valuenow="{{ $boss->current_health }}" aria-valuemin="0"
                aria-valuemax="{{ $boss->total_health }}">
                {{ $boss->current_health }} / {{ $boss->total_health }}
            </div>
        </div>
        @if ($boss->type == 'User')
            <div class="alert alert-warning">
                <i class="fas fa-user"></i> This boss is an individual challenge, with each user having their own battle.
            </div>
        @endif
        <div class="world-entry-text">
            @if ($boss->start_at || $boss->end_at)
                <div class="alert alert-info mt-3">
                    <i class="fas fa-calendar"></i> This boss is active
                    {!! $boss->start_at ? 'from ' . pretty_date($boss->start_at) : 'from the beginning of time' !!}
                    {!! $boss->end_at ? 'until ' . pretty_date($boss->end_at) : 'until the end of time' !!}.
                </div>
            @endif
            @if (isset($boss->idUrl) && $boss->idUrl)
                <a href="{{ $boss->idUrl }}" class="btn btn-danger btn-block">
                    {{-- challenge --}}
                    <i class="fas fa-crosshairs"></i> Challenge Boss
                </a>
            @endif
        </div>
    </div>
</div>
