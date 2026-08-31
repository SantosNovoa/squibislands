<ul>
    <li class="sidebar-header"><a href="{{ url('premium-shop') }}" class="card-link">Premium Shop</a></li>
    @if (Auth::check())
        <li class="sidebar-section">
            <div class="sidebar-section-header">History</div>
            <div class="sidebar-item"><a href="{{ url('premium-shop/history') }}" class="{{ set_active('shops/history') }}">My Purchase History</a></div>
        </li>
    @endif
</ul>
