{{--
    Dashboard shortcuts (Dailies / Shops / Prompts / Inventory): icon with a label underneath,
    in a 2x2 grid beside Recent News.
    Icons come from Site Images (Admin > Site Images) using the keys added to
    config/lorekeeper/image_files.php. Upload square PNGs with transparent backgrounds.
    If an icon hasn't been uploaded yet, a Font Awesome icon is shown in its place.
    The list lives in config/lorekeeper/dashboard_shortcuts.php; which ones show is set in
    Admin > Event Banners. The grid sizes itself to however many are on.
--}}
@php
    $shortcuts = $shortcuts ?? \App\Models\EventBanner::dashboardShortcuts();
    $count = $shortcuts->count();
    // lg: 1 column for a single shortcut, otherwise 2 columns with as many rows as needed
    $lgCols = $count == 1 ? 1 : 2;
    $lgRows = (int) ceil($count / $lgCols);
@endphp

<div class="si-shortcuts" style="--si-cols: {{ min($count, 4) }}; --si-sm-cols: {{ min($count, 2) }}; --si-lg-cols: {{ $lgCols }}; --si-lg-rows: {{ $lgRows }};">
    @foreach ($shortcuts as $shortcut)
        @php
            $filename = config('lorekeeper.image_files.' . $shortcut['image_key'] . '.filename');
            $hasImage = $filename && file_exists(public_path('images/' . $filename));
        @endphp
        <a href="{{ url($shortcut['url']) }}" class="si-shortcut">
            <div class="si-shortcut-icon">
                @if ($hasImage)
                    <img src="{{ asset('images/' . $filename) }}?v={{ filemtime(public_path('images/' . $filename)) }}" alt="">
                @else
                    <i class="{{ $shortcut['icon'] }}" aria-hidden="true"></i>
                @endif
            </div>
            <h3 class="si-shortcut-label">{{ $shortcut['label'] }}</h3>
        </a>
    @endforeach
</div>

<style>
    .si-shortcuts {
        /* Change these to restyle the labels (e.g. in the dark theme) */
        --si-shortcut-label: #0c33a7;
        --si-shortcut-label-hover: #041342;

        display: grid;
        grid-template-columns: repeat(var(--si-cols, 4), 1fr);
        gap: .75rem .5rem;
    }

    .si-shortcut {
        min-width: 0;
        min-height: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .si-shortcut:hover,
    .si-shortcut:focus {
        text-decoration: none;
    }

    .si-shortcut-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform .15s ease, filter .15s ease;
    }

    .si-shortcut-icon img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        filter: drop-shadow(0 2px 3px rgba(4, 19, 66, .25));
    }

    .si-shortcut-icon i {
        font-size: 2.75rem;
        color: var(--si-shortcut-label);
    }

    .si-shortcut:hover .si-shortcut-icon,
    .si-shortcut:focus .si-shortcut-icon {
        transform: translateY(-3px) scale(1.06);
        filter: brightness(1.08);
    }

    /* h3 so it inherits the site's heading font, like the card headers */
    .si-shortcut-label {
        margin: .3rem 0 0;
        font-size: 1.05rem;
        line-height: 1.2;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: var(--si-shortcut-label);
        transition: color .15s ease;
    }

    .si-shortcut:hover .si-shortcut-label,
    .si-shortcut:focus .si-shortcut-label {
        color: var(--si-shortcut-label-hover);
    }

    /*
     * lg and up: 2x2 grid beside Recent News. The grid fills the column exactly
     * (Bootstrap columns are position: relative and stretch to the news card's height),
     * and the icons shrink or grow to fit, so the shortcuts never make the row taller.
     */
    @media (min-width: 992px) {
        /*
         * The news widget's card has its own mb-4, which makes the news column 1.5rem taller
         * than the card, so the grid (which fills the column) would hang below it.
         * The column's own mb-4 already provides the spacing, so drop the card's.
         * Needs the si-news-col class on the news column in pages/_dashboard.blade.php.
         */
        .si-news-col > :last-child {
            margin-bottom: 0 !important;
        }

        .si-shortcuts {
            position: absolute;
            top: 0;
            bottom: 0;
            left: 15px;
            right: 15px;
            grid-template-columns: repeat(var(--si-lg-cols, 2), 1fr);
            grid-template-rows: repeat(var(--si-lg-rows, 2), 1fr);
            gap: .5rem;
        }

        .si-shortcut-icon {
            flex: 1 1 auto;
            min-height: 0;
            width: 100%;
            height: auto;
            max-height: 130px;
        }

        .si-shortcut-icon i {
            font-size: 3.25rem;
        }

        .si-shortcut-label {
            font-size: 1.15rem;
        }
    }

    /* Phones: 2x2 under the news card */
    @media (max-width: 575.98px) {
        .si-shortcuts {
            grid-template-columns: repeat(var(--si-sm-cols, 2), 1fr);
        }

        .si-shortcut-icon {
            width: 72px;
            height: 72px;
        }

        .si-shortcut-icon i {
            font-size: 2.5rem;
        }

        .si-shortcut-label {
            font-size: .95rem;
        }
    }
</style>