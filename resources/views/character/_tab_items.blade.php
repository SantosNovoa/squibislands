@if (count($items))
    @foreach ($items as $categoryId => $categoryItems)
        <div class="row">
            <div id="gridView">
                <div class="row p-3 g-2 g-md-0" style="margin: 0 !important;">
                    @foreach ($categoryItems as $itemtype)
                        <div class="align-items-center character-items-info-container">
                            <img src="{{ $itemtype->first()->imageUrl }}"  alt="{{ $itemtype->first()->name }}" class="rounded img-fluid character-item-img" />
                            <div class="items-text-container d-flex justify-content-center" style="gap: 5px;">
                                <span>{{ $itemtype->first()->name }} x{{ $itemtype->sum('pivot.count') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
@else
    <p class="text-center">No available items.</p>
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
