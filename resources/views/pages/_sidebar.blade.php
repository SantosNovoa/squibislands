<ul class="text-center">
    <li class="sidebar-header"><a href="#" class="card-link" style="display: block; color: white; font-size: 17px; font-family: DynaPuff, serif !important;">Featured Character</a></li>

    <li class="sidebar-section p-2 feat-container">
        @if(isset($featured) && $featured)
            <div class="featured-character">
                <a href="{{ $featured->url }}"><img src="{{ $featured->image->thumbnailUrl }}" class="img-thumbnail" /></a>
            </div>
            <div class="mt-1">
                <a href="{{ $featured->url }}" class="h5 mb-0">@if(!$featured->is_visible) <i class="fas fa-eye-slash"></i> @endif {{ Illuminate\Support\Str::limit($featured->fullName, 15, $end = '...')  }}</a>
            </div>
            <div class="small">
                {!! $featured->image->species_id ? $featured->image->species->displayName : 'No Species' !!} ・ {!! $featured->displayOwner !!}
            </div>
        @else
            <p>There is no featured character.</p>
        @endif
    </li>
</ul>
