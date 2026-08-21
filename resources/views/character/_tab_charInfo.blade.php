@if ($image->character->homeSetting)
    <div class="row no-gutters">
        <div class="col-lg-4 col-5">
            <h4>Home</h4>
        </div>
        <div class="col-lg-8 col-7 pl-1">{!! $image->character->location ? $image->character->location : 'None' !!}</div>
    </div>
@endif
@if ($image->character->factionSetting)
    <div class="row no-gutters">
        <div class="col-lg-4 col-5">
            <h4>Faction</h4>
        </div>
        <div class="col-lg-8 col-7 pl-1">{!! $image->character->faction ? $image->character->currentFaction : 'None' !!}{!! $character->factionRank ? ' (' . $character->factionRank->name . ')' : null !!}</div>
    </div>
@endif

<div class="row no-gutters">
    <div class="col-lg-4 col-5">
        <h5>Class</h5>
    </div>
    <div class="col-lg-8 col-7 pl-1">{!! $image->character->class_id ? $image->character->class->displayName : 'None' !!}
        @if (Auth::check())
            @if (Auth::user()->isStaff || (Auth::user()->id == $image->character->user_id && $image->character->class_id == null))
                <a href="#" class="btn btn-outline-info btn-sm edit-class ml-1" data-id="{{ $image->character->id }}"><i class="fas fa-cog"></i></a>
            @endif
        @endif
    </div>
</div>

@php
    // check if there is a type for this object if not passed
    // for characters first check subtype (since it takes precedence)
    $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Character\CharacterImage')->where('typing_id', $image->id)->first();
    if (!isset($type) && $image->subtype_id) {
        $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Species\Subtype')->where('typing_id', $image->subtype_id)->first();
    }
    if (!isset($type)) {
        $type = \App\Models\Element\Typing::where('typing_model', 'App\Models\Species\Species')->where('typing_id', $image->species_id)->first();
    }
    $type = $type ?? null;
@endphp
@if ($type || (Auth::check() && Auth::user()->hasPower('manage_characters')))
    <div class="row no-gutters">
        <div class="col-lg-4 col-5">
            <h5>Typing</h5>
        </div>
        <div class="col-lg-8 col-7 pl-1">
            <h5>{!! $type?->displayElements !!}</h5>
            @if (Auth::check() && Auth::user()->hasPower('manage_characters'))
                {!! add_help('Typing is assigned on an image basis') !!}
                <div class="ml-auto">
                    <a href="#" class="btn btn-outline-info btn-sm edit-typing" data-id="{{ $image->id }}">
                        <i class="fas fa-cog"></i> {{ $type ? 'Edit' : 'Create' }}
                    </a>
                </div>
            @endif
        </div>
    </div>
@endif

<h4>
    <span>
    {{ $character->level->nextLevel ? 'Current Lvl: ' . $character->level->current_level : 'Max Level' }}
    </span>
</h4>

<div class="card mb-3">
    <div class="card-body">
        <div class="container text-center mb-3">
            @if ($character->level->nextLevel)
                <p><b>Next Level:</b> {{ $character->level->nextLevel->level }}</p>
                {{ $character->level->current_exp }}/{{ $character->level->nextLevel->exp_required }}
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active progress-bar-animated" role="progressbar" aria-valuenow="{{ $character->level->current_exp }}" aria-valuemin="0" aria-valuemax="{{ $character->level->nextLevel->exp_required }}"
                        style="width:{{ $character->level->progressBarWidth }}%">
                        {{ $character->level->current_exp }}/{{ $character->level->nextLevel->exp_required }}
                    </div>
                </div>
                @if ($character->level->current_exp >= $character->level->nextLevel->exp_required && Auth::check() && ($character->level->user ?? Auth::user()->id == $level->character?->user_id))
                    <div class="text-center m-1">
                        <b>
                            <p>You have enough EXP to advance to the next level!</p>
                        </b>
                    </div>
                    {!! Form::open(['url' => $character->level->user ? '/userstats/level' : $level->character->url . '/stats/level']) !!}

                    {!! Form::submit('Level up!', ['class' => 'btn btn-success mb-2']) !!}

                    {!! Form::close() !!}
                @endif
            @else
                {{ $character->level->current_exp }} Exp (Max Level)
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{ $character->level->current_exp }}" aria-valuemin="0" aria-valuemax="{{ $character->level->current_exp }}" style="width:100%">
                        {{ $character->level->current_exp }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

@if ($character->weapons->count() || $character->gear->count())
    @if ($character->weapons->count())
        <h4>Weapons</h4>
        <div class="row justify-content-begin" style="margin: 0 !important; gap: 10px;">
            @foreach ($character->weapons as $weapon)
                <div class="col-md-2 character-armoury-info-container">
                    @if ($weapon->has_image)
                        <img class="img-fluid rounded character-armoury-img" src="{{ $weapon->imageUrl }}" data-toggle="tooltip" />
                    @elseif($weapon->weapon->imageUrl)
                        <img class="img-fluid rounded character-armoury-img" src="{{ $weapon->weapon->imageUrl }}" data-toggle="tooltip" />
                    @else
                        {!! $weapon->weapon->name !!}
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @if ($character->gear->count())
        <h4 class="pt-2">Gear</h4>
        <div class="row justify-content-begin" style="margin: 0 !important; gap: 10px;">
            @foreach ($character->gear as $gear)
                <div class="col-md-2 character-armoury-info-container">
                    @if ($gear->has_image)
                        <img class="img-fluid rounded character-armoury-img" src="{{ $gear->imageUrl }}" data-toggle="tooltip" />
                    @elseif($gear->gear->imageUrl)
                        <img class="img-fluid rounded character-armoury-img" src="{{ $gear->gear->imageUrl }}" data-toggle="tooltip" />
                    @else
                        {!! $gear->gear->name !!}
                    @endif
                </div>
            @endforeach
        </div>
    @endif
@else
    <p class="text-center">No available armoury items.</p>
@endif

<script>
    $(function() {
        $('.children-charInfo ul').hide();
        $('.children-charInfo>ul').show();
        $('.children-charInfo ul.active').show();
        $('.children-charInfo li').on('click', function(e) {
            var children = $(this).find('> ul');
            if (children.is(":visible")) children.hide('fast').removeClass('active');
            else children.show('fast').addClass('active');
            e.stopPropagation();
        });
    });
</script>
