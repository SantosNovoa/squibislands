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
                <i class="fas fa-eye-slash mr-1" data-toggle="tooltip" title="Inactive - you can still see this as staff"></i>
            @endif
            @if ($boss->is_staff_only)
                <i class="fas fa-crown mr-1" data-toggle="tooltip" title="Staff Only"></i>
            @endif
            {!! $boss->displayName !!}
        </h3>
        {!! $boss->healthBar(!$boss->is_active, Auth::user() ?? null) !!}
        @if ($boss->type == 'User')
            <div class="alert alert-warning">
                <i class="fas fa-user"></i> This boss is an individual challenge, with each user having their own battle.
            </div>
        @endif
        <div class="world-entry-text">
            @if ($boss->start_at || $boss->end_at)
                <div class="alert alert-info">
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
