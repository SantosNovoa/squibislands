@if (count($awards))
    @foreach ($awards as $categoryId => $categoryAwards)
        <div class="row">
            <div id="gridView">
                <div class="row p-3 g-2 g-md-0" style="margin: 0 !important;">
                    @foreach ($categoryAwards as $awardtype)
                        <div class="align-items-center character-items-info-container">
                            <img src="{{ $awardtype->first()->imageUrl }}"  alt="{{ $awardtype->first()->name }}" class="rounded img-fluid character-item-img" />
                            <div class="items-text-container d-flex justify-content-center" style="gap: 5px;">
                                <span>{{ $awardtype->first()->name }} x{{ $awardtype->sum('pivot.count') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="text-center">No available badges.</p>
@endif

<script>
    $(function() {
        $('.children-item ul').hide();
        $('.children-item>ul').show();
        $('.children-item ul.active').show();
        $('.children-item li').on('click', function(e) {
            var children = $(this).find('> ul');
            if (children.is(":visible")) children.hide('fast').removeClass('active');
            else children.show('fast').addClass('active');
            e.stopPropagation();
        });
    });
</script>