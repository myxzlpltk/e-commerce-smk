@extends('layouts.default.app')

@section('title', 'Waduuhhh... Kamu harus login terlebih dahulu')

@push('stylesheets')
@endpush

@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h1 class="text-dark">Waduuhhh...</h1>
                            <p class="text-lead text-dark">Kamu harus masuk terlebih dahulu sebelum melanjutkan</p>
                            <a href="{{ route('login') }}" class="btn hero-btn"><i class="fa fa-sign-in-alt fa-fw"></i> Masuk</a>
                            <a href="{{ route('register') }}" class="btn hero-btn"><i class="fa fa-user fa-fw"></i> Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End-->
@endsection

@push('scripts')
@endpush
