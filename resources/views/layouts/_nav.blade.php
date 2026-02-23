<div class="nav-container">
    <div class="clock-container">
        <div class="time">

        </div>
        <div class="am-pm">

        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" id="headerNav">
        <div class="container-fluid">

            @if (View::hasSection('sidebar'))
                <a href="#" class="btn btn-sm btn-outline-light" id="mobileMenuButton"> <i class="fas fa-caret-right ml-0"></i></a>
            @endif


            <div class="home-container-mobile">
                <a href="{{ url('/') }}" class="text-white" style="font-family: CherryBombOne, serif; font-size: 18px; text-transform: uppercase;">Squib Islands</a>
            </div>
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown">
                        @if (Auth::check() && Auth::user()->is_news_unread && config('lorekeeper.extensions.navbar_news_notif') || Auth::check() && Auth::user()->is_sales_unread && config('lorekeeper.extensions.navbar_news_notif'))
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle text-warning" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fas fa-bell"></i><span class="nav-text"><strong>Official</strong></span>
                        </a>
                        @else
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-envelope"></i> <span class="nav-text">Official</span>
                        </a>
                        @endif
                        <div class="dropdown-menu animate slideIn" aria-labelledby="inventoryDropdown">
                            @if (Auth::check() && Auth::user()->is_news_unread && config('lorekeeper.extensions.navbar_news_notif'))
                                <a class="dropdown-item d-flex text-warning" href="{{ url('news') }}"><strong><i class="fa-solid fa-newspaper"></i> News</strong></a>
                            @else
                                <a class="dropdown-item" href="{{ url('news') }}">
                                   <i class="fa-solid fa-newspaper"></i> News
                                </a>
                            @endif
                            @if (Auth::check() && Auth::user()->is_sales_unread && config('lorekeeper.extensions.navbar_news_notif'))
                                <a class="dropdown-item d-flex text-warning" href="{{ url('sales') }}"><strong><i class="fa-solid fa-shop"></i> Sales</strong></a>
                            @else
                                <a class="dropdown-item" href="{{ url('sales') }}">
                                   <i class="fa-solid fa-shop"></i> Sales
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ url('info/official_customs') }}">
                              <i class="fa-solid fa-palette"></i> Customs
                            </a>
                            <a class="dropdown-item" href="{{ url('raffles') }}">
                               <i class="fa-solid fa-dice"></i> Raffles
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-paw"></i> <span class="nav-text">Species</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-two-column animate slideIn"aria-labelledby="navbarDropdown">
                            <div class="dropdown-column">
                                <h3 class="dropdown-header" style="color: black;font-size: 18px; text-align:center;">Guides</h3>
                                <div class="dropdown-divider-col-left"></div>
                                <a class="dropdown-item" href="{{ url('info/sqb_overview') }}">
                                    <i class="fa-solid fa-anchor"></i> Overview
                                </a>
                                <a class="dropdown-item" href="{{ url('info/squib_subtypes') }}">
                                    <i class="fa-solid fa-droplet"></i> Subtypes
                                </a>
                                <a class="dropdown-item" href="{{ url('info/squib_design') }}">
                                    <i class="fa-solid fa-paintbrush"></i> Designing
                                </a>
                                <a class="dropdown-item" href="{{ url('info/magic_guide') }}">
                                    <i class="fa-solid fa-wand-sparkles"></i> Magic
                                </a>
                                <a class="dropdown-item" href="{{ url('info/companions') }}">
                                    <i class="fa-solid fa-paw"></i> Companions
                                </a>
                            </div>
                            <div class="dropdown-column">
                                <h3 class="dropdown-header" style="color: black;font-size: 18px; text-align:center;">Traits</h3>
                                <div class="dropdown-divider-col-right"></div>
                                <a class="dropdown-item" href="{{ url('world/species/1/traits') }}">
                                    <i class="fa-solid fa-rectangle-list"></i>  Traits
                                </a>
                                <a class="dropdown-item" href="{{ url('world/subtypes/1/traits') }}">
                                   <i class="fa-solid fa-caret-right"></i> Saltwater
                                </a>
                                <a class="dropdown-item" href="{{ url('world/subtypes/4/traits') }}">
                                   <i class="fa-solid fa-caret-right"></i> Freshwater
                                </a>
                                <a class="dropdown-item" href="{{ url('world/subtypes/2/traits') }}">
                                   <i class="fa-solid fa-caret-right"></i> Squibble
                                </a>
                                <a class="dropdown-item" href="{{ url('world/subtypes/3/traits') }}">
                                   <i class="fa-solid fa-caret-right"></i> Krakens
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-circle-info"></i> <span class="nav-text">Info</span>
                        </a>

                        <div class="dropdown-menu animate slideIn" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('info/beginner') }}">
                              <i class="fa-solid fa-hourglass-start"></i> Beginners Guide
                            </a>
                            <a class="dropdown-item" href="{{ url('info/masterlist_images') }}">
                               <i class="fa-solid fa-image"></i> Masterlist Images
                            </a>
                            <a class="dropdown-item" href="{{ url('info/MYO_submissions_updates') }}">
                              <i class="fa-solid fa-brush"></i> MYO Submissions & Updates
                            </a>
                            <a class="dropdown-item" href="{{ url('info/submission_rewards') }}">
                               <i class="fa-solid fa-paintbrush"></i> Art & Writing Rewards
                            </a>
                            <a class="dropdown-item" href="{{ url('info/claims_guide') }}">
                               <i class="fa-solid fa-circle-exclamation"></i> Character & Item Claims
                            </a>
                            <a class="dropdown-item" href="{{ url('world') }}">
                               <i class="fa-solid fa-magnifying-glass"></i> Encyclopedia
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-rectangle-list"></i> <span class="nav-text">Masterlist</span>
                        </a>

                        <div class="dropdown-menu animate slideIn" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('masterlist') }}">
                               <i class="fa-solid fa-fish"></i> Character Masterlist
                            </a>
                            <a class="dropdown-item" href="{{ url('sublist/npc_designs') }}">
                               <i class="fa-solid fa-heart"></i> NPCs
                            </a>
                        </div>
                    </li>

                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-gamepad"></i> <span class="nav-text">Activities</span>
                            </a>
                            <div class="dropdown-menu animate slideIn" aria-labelledby="inventoryDropdown">
                                <a class="dropdown-item" href="{{ url('prompts/prompts') }}">
                                   <i class="fa-solid fa-pen-fancy"></i> Prompts
                                </a>
                                <a class="dropdown-item" href="{{ url('gallery') }}">
                                   <i class="fa-solid fa-images"></i> Galleries
                                </a>
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="{{ url('shops') }}">
                                   <i class="fa-solid fa-store"></i> Shops
                                </a>
                                <a class="dropdown-item" href="{{ url('dailies') }}">
                                   <i class="fa-solid fa-alarm-clock"></i> Dailies
                                </a>
                                <a class="dropdown-item" href="{{ url('crafting') }}">
                                   <i class="fa-solid fa-hammer"></i> Crafting
                                </a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-user-group"></i> <span class="nav-text">Community</span>
                        </a>

                        <div class="dropdown-menu animate slideIn" aria-labelledby="browseDropdown">
                            <a class="dropdown-item" href="{{ url('users') }}">
                               <i class="fa-solid fa-users"></i> Users
                            </a>
                            <a class="dropdown-item" href="https://discord.gg/whc3mVZJMp" target="_blank" rel="noopener noreferrer">
                               <i class="fa-brands fa-discord"></i> Discord
                            </a>
                            <a class="dropdown-item" href="https://www.deviantart.com/squibtank">
                               <i class="fa-brands fa-deviantart"></i> Deviantart
                            </a>
                            <a class="dropdown-item" href="https://ko-fi.com/squibislands">
                               <i class="fa-solid fa-mug-hot"></i> Ko-fi Shop
                            </a>
                            <a class="dropdown-item" href="https://toyhou.se/~world/52279.squib-islands">
                               <i class="fa-solid fa-house"></i> Toyhouse
                            </a>
                        </div>
                    </li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    {!! LiveClock() !!}
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @endif
                    @else
                        @if (Auth::user()->isStaff)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('admin') }}"><i class="fas fa-crown"></i></a>
                            </li>
                        @endif
                        @if (Auth::user()->notifications_unread)
                            <li class="nav-item">
                                <a class="nav-link btn btn-secondary btn-sm" href="{{ url('notifications') }}"><span class="fas fa-envelope"></span> {{ Auth::user()->notifications_unread }}</a>
                            </li>
                        @endif

                        <li class="nav-item dropdown">
                            <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                Submit
                            </a>

                            <div class="dropdown-menu animate slideIn" aria-labelledby="browseDropdown">
                                <a class="dropdown-item" href="{{ url('submissions/new') }}">
                                   <i class="fa-solid fa-file-arrow-up"></i> Prompt
                                </a>
                                <a class="dropdown-item" href="{{ url('claims/new') }}">
                                   <i class="fa-solid fa-circle-exclamation"></i> Claim
                                </a>
                                <a class="dropdown-item" href="{{ url('reports/new') }}">
                                   <i class="fa-solid fa-flag"></i> Report
                                </a>
                                <a class="dropdown-item" href="{{ url('trades/create') }}">
                                   <i class="fa-solid fa-arrow-right-arrow-left"></i> Trades
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ Auth::user()->url }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-two-column animate slideIn" aria-labelledby="navbarDropdown">
                                <div class="dropdown-column">
                                    <a class="dropdown-item" href="{{ url('inventory') }}">
                                       <i class="fa-solid fa-boxes-stacked"></i> Inventory
                                    </a>
                                    <a class="dropdown-item" href="{{ url('bank') }}">
                                       <i class="fa-solid fa-piggy-bank"></i> Bank
                                    </a>
                                    <a class="dropdown-item" href="{{ url('badgecase') }}">
                                       <i class="fa-solid fa-certificate"></i> Badges
                                    </a>
                                    <a class="dropdown-item" href="{{ url('characters') }}">
                                       <i class="fa-solid fa-house-user"></i> Characters
                                    </a>
                                    <a class="dropdown-item" href="{{ url('characters/myos') }}">
                                       <i class="fa-solid fa-id-card"></i> MYO Slots
                                    </a>
                                    <a class="dropdown-item" href="{{ url('designs') }}">
                                       <i class="fa-solid fa-file-circle-check"></i> Design Approvals
                                    </a>
                                    <a class="dropdown-item" href="{{ url('pets') }}">
                                       <i class="fa-solid fa-paw"></i> Pets
                                    </a>
                                </div>
                                <div class="dropdown-column">
                                    <a class="dropdown-item" href="{{ Auth::user()->url }}">
                                       <i class="fa-solid fa-user"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ url('notifications') }}">
                                       <i class="fa-solid fa-bell"></i> Notifications
                                    </a>
                                    <a class="dropdown-item" href="{{ url('mail') }}">
                                      <i class="fa-solid fa-envelope"></i> Mail
                                    </a>
                                    <a class="dropdown-item" href="{{ url('account/bookmarks') }}">
                                       <i class="fa-solid fa-bookmark"></i> Bookmarks
                                    </a>
                                    <a class="dropdown-item" href="{{ url('comments/liked') }}">
                                       <i class="fa-solid fa-heart"></i> Liked Comments
                                    </a>
                                    <a class="dropdown-item" href="{{ url('account/settings') }}">
                                       <i class="fa-solid fa-gear"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                       <i class="fa-solid fa-right-from-bracket"></i> {{ __('Logout') }}
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    @if(Auth::check()) 
                        <div class="clock-currency-container-mobile-view justify-content-center">
                            <div class="time bg-transparent">

                            </div>
                            <div class="am-pm bg-transparent">

                            </div>
                            <div class="currency-container-mobile-view d-flex align-items-center">
                                @foreach(Auth::user()->getCurrencies(false) as $currency)
                                    <div class="pl-1 pr-1">{!! $currency->display($currency->quantity) !!}</div>
                                @endforeach 
                            </div>
                        </div>
                        <a href="{{ url('dailies') }}" class="dailies-mobile pb-3" style="font-family: CherryBombOne, serif; text-transform: uppercase;">
                            Dailies <i class="fas fa-arrow-right"></i>
                        </a>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</div>