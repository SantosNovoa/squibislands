{{--
    Shop hub tile (User Shops / My Shop / Supporter Shop on the Shops page).
    Uses the same markup as shops._shop so it picks up the normal shop tile styling.
    The image is uploaded in Admin > Site Images ($imageKey is a key in config/lorekeeper/image_files.php).
    Like a normal shop with no image, only the name shows until one is uploaded.
--}}
@php
    $filename = config('lorekeeper.image_files.' . $imageKey . '.filename');
    $hasImage = $filename && file_exists(public_path('images/' . $filename));
@endphp
<div class="{{ $colClass ?? 'col-md-3 col-6' }} mb-3 text-center">
    <div class="shop-image">
        @if ($hasImage)
            <a href="{{ $url }}"><img src="{{ asset('images/' . $filename) }}?v={{ filemtime(public_path('images/' . $filename)) }}" alt="{{ $label }}" /></a>
        @endif
    </div>
    <div class="shop-name mt-1">
        <a href="{{ $url }}" class="h5 mb-0">{{ $label }}</a>
    </div>
</div>
