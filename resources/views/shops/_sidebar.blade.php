<ul>
    <li class="sidebar-header"><a href="{{ url('shops') }}" class="card-link">Shops</a></li>

    @if (Auth::check())
        <li class="sidebar-section">
            <div class="sidebar-section-header">History</div>
            <div class="sidebar-item"><a href="{{ url('shops/history') }}" class="{{ set_active('shops/history') }}">My Purchase History</a></div>
            <div class="sidebar-section-header">My Currencies</div>
            @foreach (Auth::user()->getCurrencies(true) as $currency)
                <div class="sidebar-item d-flex justify-content-center">{!! $currency->display($currency->quantity) !!}</div>
            @endforeach
        </li>
    @endif

    <li class="sidebar-section">
        <div class="sidebar-section-header">Shops</div>
        @foreach ($shops as $shop)
            @if ($shop->is_staff)
                @if (auth::check() && auth::user()->isstaff)
                    <div class="sidebar-item"><a href="{{ $shop->url }}" class="{{ set_active('shops/' . $shop->id) }}">{{ $shop->name }}</a></div>
                @endif
            @else
                <div class="sidebar-item"><a href="{{ $shop->url }}" class="{{ set_active('shops/' . $shop->id) }}">{{ $shop->name }}</a></div>
            @endif
        @endforeach
    </li>
    <li class="sidebar-section">
        <div class="sidebar-section-header">More Shops</div>
        @if (Auth::check())
            <div class="sidebar-item"><a href="{{ url('user-shops/shop-index') }}" class="{{ set_active('user-shops/shop-index') }}">User Shops</a></div>
            @if (Settings::get('user_shop_limit') == 1)
                <div class="sidebar-item"><a href="{{ Auth::user()->shops()->first()?->editUrl ?? url('user-shops/create') }}">My Shop</a></div>
            @else
                <div class="sidebar-item"><a href="{{ url('user-shops') }}" class="{{ set_active('user-shops') }}">My Shops</a></div>
            @endif
        @endif
        <div class="sidebar-item"><a href="{{ url('premium-shop') }}" class="{{ set_active('premium-shop') }}">Supporter Shop</a></div>
    </li>
</ul>
