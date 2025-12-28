<div class="nav-container">
    <div class="clock-container">
        <div class="time">

        </div>
        <div class="am-pm">

        </div>
    </div>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark" id="headerNav">
        <div class="container-fluid">

            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa-solid fa-sailboat"></i>
            </a>
            
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
                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            @if (Auth::check() && Auth::user()->is_news_unread && config('lorekeeper.extensions.navbar_news_notif'))
                                <a class="dropdown-item d-flex text-warning" href="{{ url('news') }}"><strong>News</strong></a>
                            @else
                                <a class="dropdown-item" href="{{ url('news') }}">
                                    News
                                </a>
                            @endif
                            @if (Auth::check() && Auth::user()->is_sales_unread && config('lorekeeper.extensions.navbar_news_notif'))
                                <a class="dropdown-item d-flex text-warning" href="{{ url('sales') }}"><strong>Sales</strong></a>
                            @else
                                <a class="dropdown-item" href="{{ url('sales') }}">
                                    Sales
                                </a>
                            @endif
                            <a class="dropdown-item" href="{{ url('info/official_customs') }}">
                                Customs
                            </a>
                            <a class="dropdown-item" href="{{ url('raffles') }}">
                                Raffles
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-paw"></i> <span class="nav-text">Species</span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('info/sqb_overview') }}">
                                Overview
                            </a>
                            <a class="dropdown-item" href="{{ url('info/squib_subtypes') }}">
                                SubTypes
                            </a>
                            <a class="dropdown-item" href="{{ url('info/squib_design') }}">
                                Design Guide
                            </a>
                            <a class="dropdown-item" href="{{ url('world/species/1/traits') }}">
                                Trait Index
                            </a>
                            <a class="dropdown-item" href="{{ url('info/companions') }}">
                                Companions
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-circle-info"></i> <span class="nav-text">Info</span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('info/beginner') }}">
                                Beginners Guide
                            </a>
                            <a class="dropdown-item" href="{{ url('info/masterlist_images') }}">
                                Masterlist Images
                            </a>
                            <a class="dropdown-item" href="{{ url('info/MYO_submissions_updates') }}">
                                MYO Submissions & Updates
                            </a>
                            <a class="dropdown-item" href="{{ url('info/submission_rewards') }}">
                                Art & Writing Rewards
                            </a>
                            <a class="dropdown-item" href="{{ url('info/claims_guide') }}">
                                Character & Item Claims
                            </a>
                            <a class="dropdown-item" href="{{ url('world') }}">
                                Encyclopedia
                            </a>
                        </div>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-rectangle-list"></i> <span class="nav-text">Masterlist</span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                            <a class="dropdown-item" href="{{ url('masterlist') }}">
                                Character Masterlist
                            </a>
                            <a class="dropdown-item" href="{{ url('sublist/npc_designs') }}">
                                NPCs
                            </a>
                        </div>
                    </li>

                    @if (Auth::check())
                        <li class="nav-item dropdown">
                            <a id="inventoryDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <i class="fa-solid fa-gamepad"></i> <span class="nav-text">Activities</span>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="inventoryDropdown">
                                <a class="dropdown-item" href="{{ url('prompts/prompts') }}">
                                    Prompts
                                </a>
                                <a class="dropdown-item" href="{{ url('gallery') }}">
                                    Galleries
                                </a>
                                {{-- <div class="dropdown-divider"></div> --}}
                                <a class="dropdown-item" href="{{ url('shops') }}">
                                    Shops
                                </a>
                                <a class="dropdown-item" href="{{ url('dailies') }}">
                                    Dailies
                                </a>
                                <a class="dropdown-item" href="{{ url('crafting') }}">
                                    Crafting
                                </a>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a id="browseDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="fa-solid fa-user-group"></i> <span class="nav-text">Community</span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="browseDropdown">
                            <a class="dropdown-item" href="{{ url('users') }}">
                                Users
                            </a>
                            <a class="dropdown-item" href="https://discord.gg/whc3mVZJMp" target="_blank" rel="noopener noreferrer">
                                Discord
                            </a>
                            <a class="dropdown-item" href="{{ url('info/terms') }}">
                                TOS
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

                            <div class="dropdown-menu" aria-labelledby="browseDropdown">
                                <a class="dropdown-item" href="{{ url('submissions/new') }}">
                                    Prompt
                                </a>
                                <a class="dropdown-item" href="{{ url('claims/new') }}">
                                    Claim
                                </a>
                                <a class="dropdown-item" href="{{ url('reports/new') }}">
                                    Report
                                </a>
                                <a class="dropdown-item" href="{{ url('trades/create') }}">
                                    Trades
                                </a>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="{{ Auth::user()->url }}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-two-column" aria-labelledby="navbarDropdown">
                                <div class="dropdown-column">
                                    <a class="dropdown-item" href="{{ url('inventory') }}">
                                        Inventory
                                    </a>
                                    <a class="dropdown-item" href="{{ url('bank') }}">
                                        Bank
                                    </a>
                                    <a class="dropdown-item" href="{{ url('awardcase') }}">
                                        Awards
                                    </a>
                                    <a class="dropdown-item" href="{{ url('characters') }}">
                                        Characters
                                    </a>
                                    <a class="dropdown-item" href="{{ url('characters/myos') }}">
                                        MYO Slots
                                    </a>
                                    <a class="dropdown-item" href="{{ url('designs') }}">
                                        Design Approvals
                                    </a>
                                </div>
                                <div class="dropdown-column">
                                    <a class="dropdown-item" href="{{ Auth::user()->url }}">
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ url('notifications') }}">
                                        Notifications
                                    </a>
                                    <a class="dropdown-item" href="{{ url('mail') }}">
                                        Mail
                                    </a>
                                    <a class="dropdown-item" href="{{ url('account/bookmarks') }}">
                                        Bookmarks
                                    </a>
                                    <a class="dropdown-item" href="{{ url('account/settings') }}">
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
                                </div>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</div>