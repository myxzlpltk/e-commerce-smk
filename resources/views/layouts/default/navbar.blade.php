<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="menu-wrapper">
                    <!-- Logo -->
                    <div class="logo">
                        <a href="{{ route('home') }}"><img src="{{ asset('img/unit/um-logo.png') }}" alt=""></a>
                    </div>
                    <!-- Main-menu -->
                    <div class="main-menu d-none d-lg-block">
                        <nav>
                            <ul id="navigation">
                                <li><a href="{{ route('home') }}">Beranda</a></li>
                                <li><a href="#">Toko</a>
                                    <ul class="submenu" style="width: 300px">
                                        @foreach($sortedSellers as $seller)
                                        <li><a href="{{ route('sellers.show', $seller) }}">{{ $seller->store_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li><a href="#">Tentang</a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- Header Right -->
                    <div class="header-right">
                        <ul>
                            @if(Auth::guest() || Auth::user()->can('isBuyer'))
                            <li data-toggle="tooltip" title="Pencarian">
                                <div class="nav-search search-switch">
                                    <span class="fa fa-search"></span>
                                </div>
                            </li>
                            <li data-toggle="tooltip" title="Keranjang">
                                <a href="{{ route('carts.index') }}">
                                    <span class="fa fa-shopping-cart">
                                        @if(!Auth::guest() && Auth::user()->buyer)
                                            <small class="badge p-0 text-dark">{{ Auth::user()->buyer->carts()->sum('qty') }}</small>
                                        @endif
                                    </span>
                                </a>
                            </li>
                            @endif

                            @can('isSeller')
                                <li data-toggle="tooltip" title="Kelola Toko Saya"><a href="{{ route('manage') }}"><span class="fas fa-store"></span></a></li>
                            @endcan

                            @can('isAdmin')
                                <li data-toggle="tooltip" title="Dasbor"><a href="{{ route('manage') }}"><span class="fas fa-tachometer-alt"></span></a></li>
                            @endcan

                            @can('isBuyerRegistered')
                            <li data-toggle="tooltip" title="Pesanan Saya">
                                <a href="{{ route('orders.index') }}">
                                    <span class="fa fa-shipping-fast">
                                        <small class="badge p-0">{{ Auth::user()->buyer->orders()->whereIn('status_code', [1,2,3,4])->count() }}</small>
                                    </span>
                                </a>
                            </li>
                            @endcan

                            @auth
                            <li data-toggle="tooltip" title="Profil"><a href="{{ route('profile') }}"><span class="fa fa-user"></span></a></li>
                            <li data-toggle="tooltip" title="Keluar"><a href="{{ route('logout') }}"><span class="fa fa-sign-out-alt"></span></a></li>
                            @else
                            <li data-toggle="tooltip" title="Masuk"><a href="{{ route('login') }}"><span class="fa fa-sign-in-alt"></span></a></li>
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- Header End -->
</header>
