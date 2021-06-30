@extends('layouts.default.app')

@section('title', 'Selamat Datang')
@section('body.className', 'bg-white')

@push('stylesheets')
@endpush

@section('header')
@endsection

@section('content')
    <!--? slider Area Start -->
    <div class="slider-area ">
        <div class="slider-active">
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center slide-bg">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-7">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Berbagai Unit Usaha Ada Disini</h1>
                                <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">Temukan barang-barang berkualitas dengan harga terbaik dan berbagai penawaran menarik hanya di website ini.</p>
                                <!-- Hero-btn -->
                                <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                    <a href="industries.html" class="btn hero-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                            <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                <img src="img/unit/toko.png" alt="" class=" heartbeat">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Single Slider -->
            <div class="single-slider slider-height d-flex align-items-center slide-bg">
                <div class="container">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                            <div class="hero__caption">
                                <h1 data-animation="fadeInLeft" data-delay=".4s" data-duration="2000ms">Select Your New Perfect Style</h1>
                                <p data-animation="fadeInLeft" data-delay=".7s" data-duration="2000ms">Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat is aute irure.</p>
                                <!-- Hero-btn -->
                                <div class="hero__btn" data-animation="fadeInLeft" data-delay=".8s" data-duration="2000ms">
                                    <a href="industries.html" class="btn hero-btn">Shop Now</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 d-none d-sm-block">
                            <div class="hero__img" data-animation="bounceIn" data-delay=".4s">
                                <img src="img/unit/toko.png" alt="" class=" heartbeat">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--? Popular Items Start -->
    <div class="popular-items section-padding30">
        <div class="container">
            <!-- Section tittle -->
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-8 col-md-10">
                    <div class="section-tittle mb-70 text-center">
                        <h2>Produk Terbaru</h2>
                        <p>Temukan item-item terpopuler dan paling laris di website ini.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($products as $product)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="single-popular-items mb-50 text-center">
                        <div class="popular-img">
                            <img src="{{ asset("storage/products/{$product->image}") }}" alt="{{ $product->name }}">
                            <div class="img-cap">
                                <a href="{{ route('carts.add', $product) }}"><span>Tambah ke Keranjang</span></a>
                            </div>
                        </div>
                        <div class="popular-caption">
                            <h3><a href="{{ route('sellers.show', $product->seller_id) }}">{{ $product->name }}</a></h3>
                            <span>{{ App\Helpers\Helper::idr($product->price_after_discount) }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Button -->
            <div class="row justify-content-center">
                <div class="room-btn pt-70">
                    <a href="{{ route('search') }}" class="btn view-btn1">View More Products</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Popular Items End -->
    <!--? Gallery Area Start -->
    <div class="gallery-area">
        <div class="container-fluid p-0 fix">
            <div class="row">
                <div class="col-xl-6 col-lg-4 col-md-6 col-sm-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img big-img" style="background-image: url('{{ asset('img/unit/bengkelmobil.jpg') }}');"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6">
                    <div class="single-gallery mb-30">
                        <div class="gallery-img big-img" style="background-image: url('{{ asset('img/unit/agribisnis.jpg') }}');"></div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4 col-md-12">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-6 col-sm-6">
                            <div class="single-gallery mb-30">
                                <div class="gallery-img small-img" style="background-image: url('{{ asset('img/unit/artgallery.jpg') }}');"></div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12  col-md-6 col-sm-6">
                            <div class="single-gallery mb-30">
                                <div class="gallery-img small-img" style="background-image: url('{{ asset('img/unit/bengkelmotor.jpg') }}');"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Gallery Area End -->

    @guest
    <!--? Watch Choice  Start-->
    <div class="watch-area section-padding30">
        <div class="container">
            <div class="row align-items-center justify-content-between padding-130">
                <div class="col-lg-5 col-md-6">
                    <div class="watch-details mb-40">
                        <h2>Login</h2>
                        <p>Sudah memiliki akun dan ingin melakukan transaksi di website ini ? silahkan lakukan login terlebih dahulu dan nikmati seluruh fasilitas yang ditawarkan.</p>
                        <a href="{{ route('login') }}" class="btn">Login</a>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-10">
                    <div class="choice-watch-img mb-40">
                        <img src="{{ asset('img/unit/login.png') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-md-6 col-sm-10">
                    <div class="choice-watch-img mb-40">
                        <img src="{{ asset('img/unit/account.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-5 col-md-6">
                    <div class="watch-details mb-40">
                        <h2>Create Account</h2>
                        <p>Belum memiliki akun ? silahkan membuat akun dengan menekan tombol dibawah ini dan dapatkan penawaran-penawaran terbaik yang dapat anda gunakan.</p>
                        <a href="{{ route('register') }}" class="btn">Create Account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Watch Choice  End-->
    @endguest

    <!--? Shop Method Start-->
    <div class="shop-method-area">
        <div class="container">
            <div class="method-wrapper">
                <div class="row d-flex justify-content-between">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="fa fa-shipping-fast"></i>
                            <h6>Gratis Biaya Ongkir</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="fa fa-coins"></i>
                            <h6>Produk Murah</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="single-method mb-40">
                            <i class="fa fa-user-graduate"></i>
                            <h6>Mendukung Usaha Siswa</h6>
                            <p>aorem ixpsacdolor sit ameasecur adipisicing elitsf edasd.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Method End-->
@endsection

@push('scripts')
@endpush

{{--
@extends('layouts.default.app')

@section('title', 'Selamat Datang')
@section('body.className', 'bg-white')

@push('stylesheets')
@endpush

@section('header')
    <div class="header bg-gradient-indigo py-7">
        <div class="container">
            <div class="header-body">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="pr-5">
                            <h1 class="display-2 text-white font-weight-bold mb-0">Warung Semur</h1>
                            <p class="text-white">Warung serba murah berkomitmen untuk menghubungkan penjual dan pembeli dalam satu genggaman.</p>
                            <div class="card mt-5">
                                <div class="card-body">
                                    <h3 class="card-title">{{ App\Helpers\Helper::greeting() }} Kamu mau pesan apa?</h3>
                                    <form action="{{ route('search') }}" action="get">
                                        <div class="form-group">
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                                                </div>
                                                <input class="form-control" placeholder="Pesan apa aja..." type="text" name="q" id="input-q" autofocus>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary btn-block">Cari</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('img/undraw_healthy_options_sdo3.svg') }}" alt="" class="img-fluid p-5">
                    </div>
                </div>
            </div>
        </div>
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </div>
@endsection

@section('content')
    <div class="container py-5 bg-white">
        <div class="row">
            <div class="col-12">
                <h3 class="mb-3 text-dark">Toko ini lagi populer nih. Coba cek dulu, siapa tahu suka.</h3>
            </div>
            @foreach($sellers as $seller)
            <div class="col-3 col-sm-2">
                <x-seller-card :seller="$seller" />
            </div>
            @endforeach
            <div class="col-12 text-center">
                <a href="{{ route('search', ['store' => true]) }}" class="btn btn-primary">Tampilkan lebih banyak penjual</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
--}}
