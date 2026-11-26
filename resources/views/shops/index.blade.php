@extends('shops.layout')

@section('shops-title')
    Shop Index
@endsection

@section('shops-content')
    {!! breadcrumbs(['Shops' => 'shops']) !!}

    <h1>
        Shops
    </h1>

    <div class="row shops-row">
        @foreach ($shops as $shop)
            @if ($shop->is_staff)
                @if (Auth::check() && Auth::user()->isstaff)
                    @include('shops._shop')
                @endif
            @else
                @include('shops._shop')
            @endif
        @endforeach
    </div>

    @if (Auth::check())
        @php
            $myShopUrl = url('user-shops');
            if (Settings::get('user_shop_limit') == 1) {
                $myShop = Auth::user()->shops()->first();
                $myShopUrl = $myShop ? $myShop->editUrl : url('user-shops/create');
            }
        @endphp

        <hr class="shops-divider">

        <div class="row shops-row justify-content-center">
            @include('shops._hub_tile', [
                'url' => url('user-shops/shop-index'),
                'imageKey' => 'shops_user_shops',
                'label' => 'User Shops',
            ])
            @include('shops._hub_tile', [
                'url' => $myShopUrl,
                'imageKey' => 'shops_my_shop',
                'label' => Settings::get('user_shop_limit') == 1 ? 'My Shop' : 'My Shops',
            ])
        </div>
    @endif

    <hr class="shops-divider">

    <div class="row shops-row justify-content-center">
        @include('shops._hub_tile', [
            'url' => url('premium-shop'),
            'imageKey' => 'shops_supporter_shop',
            'label' => 'Supporter Shop',
            'colClass' => 'col-md-8 col-12',
        ])
    </div>
@endsection
