{{--
    Dashboard event banner.
    0 visible banners (or global toggle off) -> renders nothing
    1 visible banner                          -> static banner, no arrows/indicators, no auto-slide
    2+ visible banners                        -> Bootstrap 4 carousel with arrows + indicators (slide CSS backported from BS 4.3+/5)

    The carousel is started and controlled by the script at the bottom instead of
    Bootstrap's data-ride / data-slide attributes, so no other script on the page can
    trigger it a second time, and clicks during a transition are ignored.
--}}
@php
    $eventBanners = \App\Models\EventBanner::forDashboard();
    $isCarousel = $eventBanners->count() > 1;
@endphp

@if ($eventBanners->count())
    <div id="eventBannerCarousel" class="si-event-banner carousel slide mb-4">
        @if ($isCarousel)
            <ol class="carousel-indicators">
                @foreach ($eventBanners as $banner)
                    <li data-si-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                @endforeach
            </ol>
        @endif

        <div class="carousel-inner">
            @foreach ($eventBanners as $banner)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    @if ($banner->linkUrl)
                        <a href="{{ $banner->linkUrl }}" class="si-event-banner-link">
                    @endif

                    <img src="{{ $banner->imageUrl }}" alt="{{ $banner->name }}" class="si-event-banner-img d-block w-100">

                    @if ($banner->show_name)
                        <h2 class="si-event-banner-title mb-0">{{ $banner->name }}</h2>
                    @endif

                    @if ($banner->linkUrl)
                        </a>
                    @endif
                </div>
            @endforeach
        </div>

        @if ($isCarousel)
            <a class="carousel-control-prev" href="#" role="button" data-si-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#" role="button" data-si-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        @endif
    </div>

    <style>
        .si-event-banner {
            border-radius: .35rem;
            overflow: hidden;
            /* Shows behind images while they load; matches the card header gradient */
            background: linear-gradient(90deg, #041342 0%, #0c33a7 55%, #2a88fc 100%);
            box-shadow: 0 2px 6px rgba(0, 0, 0, .15);
        }

        .si-event-banner-img {
            aspect-ratio: 10 / 3;
            object-fit: cover;
        }

        .si-event-banner-link {
            display: block;
        }

        .si-event-banner-title {
            position: absolute;
            top: 1.25rem;
            left: 0;
            right: 0;
            padding: 0 4.5rem;
            text-align: center;
            color: #fff;
            font-size: clamp(1.25rem, 3vw, 2.25rem);
            line-height: 1.2;
            text-shadow: 0 2px 4px rgba(4, 19, 66, .8), 0 0 12px rgba(4, 19, 66, .5);
            pointer-events: none;
        }

        .si-event-banner .carousel-control-prev,
        .si-event-banner .carousel-control-next {
            width: 8%;
        }

        .si-event-banner .carousel-indicators {
            margin-bottom: .5rem;
        }

        /*
         * Slide transition backported from Bootstrap 4.3+ / 5 (float layout, 2D translateX).
         * The site's Bootstrap 4.1.3 positions the incoming slide absolutely with 3D transforms,
         * which glitches in some browsers (Bootstrap's own 4.0 docs show the same bug).
         * Bootstrap 4.1.3's JavaScript uses the same class names, so only the CSS changes.
         * The #id selectors outrank Bootstrap's carousel rules without needing !important.
         */
        #eventBannerCarousel .carousel-inner::after {
            display: block;
            clear: both;
            content: "";
        }

        #eventBannerCarousel .carousel-item {
            position: relative;
            top: auto;
            float: left;
            width: 100%;
            margin-right: -100%;
            backface-visibility: hidden;
            perspective: none;
            transform: none;
            transition: transform .6s ease-in-out;
        }

        #eventBannerCarousel .carousel-item.active,
        #eventBannerCarousel .carousel-item-next,
        #eventBannerCarousel .carousel-item-prev {
            display: block;
        }

        #eventBannerCarousel .carousel-item-next:not(.carousel-item-left),
        #eventBannerCarousel .active.carousel-item-right {
            transform: translateX(100%);
        }

        #eventBannerCarousel .carousel-item-prev:not(.carousel-item-right),
        #eventBannerCarousel .active.carousel-item-left {
            transform: translateX(-100%);
        }

        #eventBannerCarousel .carousel-item-next.carousel-item-left,
        #eventBannerCarousel .carousel-item-prev.carousel-item-right {
            transform: none;
        }

        @media (prefers-reduced-motion: reduce) {
            #eventBannerCarousel .carousel-item {
                transition: none;
            }
        }

        #eventBannerCarousel .carousel-control-prev,
        #eventBannerCarousel .carousel-control-next,
        #eventBannerCarousel .carousel-indicators {
            z-index: 3;
        }
    </style>

    @if ($isCarousel)
        <script>
            window.addEventListener('load', function () {
                var $ = window.jQuery;
                if (!$ || !$.fn.carousel) return;

                var $carousel = $('#eventBannerCarousel');
                var sliding = false;

                $carousel.carousel({ interval: 7000, pause: 'hover', ride: 'carousel' });

                $carousel
                    .on('slide.bs.carousel', function () { sliding = true; })
                    .on('slid.bs.carousel', function () { sliding = false; });

                $carousel.find('[data-si-slide]').on('click', function (e) {
                    e.preventDefault();
                    if (sliding) return;
                    $carousel.carousel($(this).data('si-slide'));
                });

                $carousel.find('[data-si-slide-to]').on('click', function (e) {
                    e.preventDefault();
                    if (sliding) return;
                    $carousel.carousel(parseInt($(this).data('si-slide-to'), 10));
                });
            });
        </script>
    @endif
@endif