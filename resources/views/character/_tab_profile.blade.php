@if ($character->profile->parsed_text || $character->is_trading || $character->is_gift_art_allowed || $character->is_gift_writing_allowed)
    @if ($character->profile->parsed_text)
        <div class="card mb-3">
            <div class="card-body parsed-text">
                {!! $character->profile->parsed_text !!}
            </div>
        </div>
    @endif

    {{-- @if ($character->is_trading || $character->is_gift_art_allowed || $character->is_gift_writing_allowed)
        <div class="card mb-3">
        <ul class="list-group list-group-flush">
            @if ($character->is_gift_art_allowed >= 1 && !$character->is_myo_slot)
                <li class="list-group-item">
                    <h5 class="mb-0"><i class="{{ $character->is_gift_art_allowed == 1 ? 'text-success' : 'text-secondary' }} far fa-circle fa-fw mr-2"></i>
                        {{ $character->is_gift_art_allowed == 1 ? 'Gift art is allowed' : 'Please ask before gift art' }}</h5>
                </li>
            @endif
            @if ($character->is_gift_writing_allowed >= 1 && !$character->is_myo_slot)
                <li class="list-group-item">
                    <h5 class="mb-0"><i class="{{ $character->is_gift_writing_allowed == 1 ? 'text-success' : 'text-secondary' }} far fa-circle fa-fw mr-2"></i>
                        {{ $character->is_gift_writing_allowed == 1 ? 'Gift writing is allowed' : 'Please ask before gift writing' }}</h5>
                </li>
            @endif
            @if ($character->is_trading)
                <li class="list-group-item">
                    <h5 class="mb-0"><i class="text-success far fa-circle fa-fw mr-2"></i> Open for trades</h5>
                </li>
            @endif
        </ul>
        </div>
    @endif --}}
@else
    <p class="text-center">This character has no profile content yet.</p>
@endif



<script>
    $(function() {
        $('.children-profile ul').hide();
        $('.children-profile>ul').show();
        $('.children-profile ul.active').show();
        $('.children-profile li').on('click', function(e) {
            var children = $(this).find('> ul');
            if (children.is(":visible")) children.hide('fast').removeClass('active');
            else children.show('fast').addClass('active');
            e.stopPropagation();
        });
    });
</script>