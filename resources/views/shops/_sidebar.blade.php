<ul>
    <li class="sidebar-header"><a href="{{ url('shops') }}" class="card-link">Shops</a></li>

<<<<<<< HEAD
    @if (Auth::check())
=======
    @if(Auth::check())
>>>>>>> Cylunny/extension/polls-and-forms
        <li class="sidebar-section">
            <div class="sidebar-section-header">History</div>
            <div class="sidebar-item"><a href="{{ url('shops/history') }}" class="{{ set_active('shops/history') }}">My Purchase History</a></div>
            <div class="sidebar-section-header">My Currencies</div>
<<<<<<< HEAD
            @foreach (Auth::user()->getCurrencies(true) as $currency)
                <div class="sidebar-item d-flex justify-content-center">{!! $currency->display($currency->quantity) !!}</div>
=======
            @foreach(Auth::user()->getCurrencies(true) as $currency)
                <div class="sidebar-item pr-3">{!! $currency->display($currency->quantity) !!}</div>
>>>>>>> Cylunny/extension/polls-and-forms
            @endforeach
        </li>
    @endif

    <li class="sidebar-section">
        <div class="sidebar-section-header">Shops</div>
<<<<<<< HEAD
        @foreach ($shops as $shop)
            @if ($shop->is_staff)
                @if (auth::check() && auth::user()->isstaff)
                    <div class="sidebar-item"><a href="{{ $shop->url }}" class="{{ set_active('shops/' . $shop->id) }}">{{ $shop->name }}</a></div>
                @endif
            @else
                <div class="sidebar-item"><a href="{{ $shop->url }}" class="{{ set_active('shops/' . $shop->id) }}">{{ $shop->name }}</a></div>
            @endif
=======
        @foreach($shops as $shop)
            <div class="sidebar-item"><a href="{{ $shop->url }}" class="{{ set_active('shops/'.$shop->id) }}">{{ $shop->name }}</a></div>
>>>>>>> Cylunny/extension/polls-and-forms
        @endforeach
    </li>
</ul>
