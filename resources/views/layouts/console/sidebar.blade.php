<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
		<div class="sidebar-brand-icon">
			<i class="fab fa-laravel"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Katalog</div>
	</a>

	<hr class="sidebar-divider my-0">

	<li class="nav-item @if(Route::is('manage')) active @endif">
		<a class="nav-link" href="{{ route('manage') }}">
			<i class="fas fa-fw fa-tachometer-alt"></i>
			<span>Dasbor</span>
		</a>
	</li>

    <hr class="sidebar-divider">

    <div class="sidebar-heading">
        Data Primer
    </div>

    @can('view-any', \App\Models\Buyer::class)
    <li class="nav-item @if(Request::segment(2) == 'buyers' || Request::segment(2) == 'users' && !empty($user->isBuyer)) active @endif">
        <a class="nav-link" href="{{ route('manage.buyers.index') }}">
            <i class="fa fa-users fa-fw"></i>
            <span>Pembeli</span>
        </a>
    </li>
    @endcan

    @can('view-any', \App\Models\Seller::class)
    <li class="nav-item @if(Request::segment(2) == 'sellers' || Request::segment(2) == 'users' && !empty($user->isSeller)) active @endif">
        <a class="nav-link" href="{{ route('manage.sellers.index') }}">
            <i class="fa fa-store fa-fw"></i>
            <span>Penjual</span>
        </a>
    </li>
    @endcan

    @can('view-any', \App\Models\Product::class)
    <li class="nav-item @if(Request::segment(2) == 'products') active @endif">
        <a class="nav-link" href="{{ route('manage.products.index')  }}">
            <i class="fa fa-boxes fa-fw"></i>
            <span>Produk</span>
        </a>
    </li>
    @endcan

    @can('view-any', \App\Models\Category::class)
    <li class="nav-item @if(Request::segment(2) == 'categories') active @endif">
        <a class="nav-link" href="{{ route('manage.categories.index')  }}">
            <i class="fa fa-tags fa-fw"></i>
            <span>Kategori</span>
        </a>
    </li>
    @endcan

    @can('view-any', \App\Models\Order::class)
    <li class="nav-item @if(Request::segment(2) == 'orders') active @endif">
        <a class="nav-link" href="{{ route('manage.orders.index') }}">
            <i class="fa fa-money-check fa-fw"></i>
            <span>Transaksi</span>
        </a>
    </li>
    @endcan

	<hr class="sidebar-divider d-none d-md-block">

	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>
</ul>
