{{-- @if (count($skills))
    @foreach ($skills->chunk(2) as $chunk)
        <div class="row">
            @foreach ($chunk as $skill)
                <div class="col-md">
                    <div class="text-center">
                        <h5>
                            {{ $skill->name }}
                        </h5>
                        @if ($character->skills()->where('skill_id', $skill->id)->exists())
                            @php
                                $characterSkill = $character
                                    ->skills()
                                    ->where('skill_id', $skill->id)
                                    ->first();
                            @endphp
                            Level: {{ $characterSkill->level }}
                    </div>
                    <div class="row">
                        @foreach ($skill->children as $children)
                            <div class="col-md  mx-auto body children-body children-scroll">
                                <div class="children-skill ">
                                    <ul>
                                        @include('character._skill_children', ['children' => $children, 'skill' => $skill])
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                </div>
                <p class="mx-auto text-center">Not unlocked.
                    <br>
                    @if ($skill->prerequisite)
                        Requires {!! $skill->prerequisite->displayname !!}
                    @endif
                </p>
            @endif
        </div>
    @endforeach
    </div>
    <hr>
@endforeach
@else
<p class="text-center">No available skills.</p>
@endif

<script>
    $(function() {
        $('.children-skill ul').hide();
        $('.children-skill>ul').show();
        $('.children-skill ul.active').show();
        $('.children-skill li').on('click', function(e) {
            var children = $(this).find('> ul');
            if (children.is(":visible")) children.hide('fast').removeClass('active');
            else children.show('fast').addClass('active');
            e.stopPropagation();
        });
    });
</script> --}}


@if (count($pets))
    @foreach ($pets->chunk(4) as $chunk)
        <div class="row">
            <div id="gridView">
                <div class="row p-3 g-2 g-md-0" style="margin: 0 !important; gap: 10px;">
                    @foreach ($chunk as $pet)
                        <div class="align-items-center character-items-info-container">
                            <a href="{{ $pet->pet->url }}">
                                <img src="{{ $pet->pet->variantImage($pet->id) }}" class="rounded img-fluid character-item-img" />
                            </a>
                            @if (config('lorekeeper.pets.pet_bonding_enabled'))
                                <div class="progress mb-2" style="width: 100%;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                        style="width: {{ ($pet->level?->nextLevel?->bonding_required ? $pet->level?->bonding / $pet->level?->nextLevel?->bonding_required : 1 * 100) . '%' }}" aria-valuenow="{{ $pet->level?->bonding }}"
                                        aria-valuemin="0" aria-valuemax="{{ $pet->level?->nextLevel?->bonding_required ?? 100 }}">
                                        {{ $pet->level?->nextLevel?->bonding_required ? $pet->level?->bonding . '/' . $pet->level?->nextLevel?->bonding_required : $pet->level?->levelName }}
                                    </div>
                                </div>
                                @if (Auth::check() && Auth::user()->id == $character->user_id && $pet->canBond())
                                    <div class="form-group mb-0">
                                        {!! Form::open(['url' => 'pets/bond/' . $pet->id]) !!}
                                        {!! Form::submit('Bond', ['class' => 'btn btn-primary']) !!}
                                        {!! Form::close() !!}
                                    </div>
                                @endif
                            @endif
                            <div class="pet-text-container d-flex justify-content-center" style="gap: 5px;">
                                @if ($pet->pet_name != null)
                                    <span style="font-style: italic;">{{ $pet->pet_name }} </span> <span> the {{ $pet->pet->name }}</span>
                                @else
                                    <span>{{ $pet->pet->name }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="text-center">No available pets.</p>
@endif

<script>
    $(function() {
        $('.children-pet ul').hide();
        $('.children-pet>ul').show();
        $('.children-pet ul.active').show();
        $('.children-pet li').on('click', function(e) {
            var children = $(this).find('> ul');
            if (children.is(":visible")) children.hide('fast').removeClass('active');
            else children.show('fast').addClass('active');
            e.stopPropagation();
        });
    });
</script>
