@extends('layouts.default.app')

@section('title', 'Pencarian Produk')

@push('stylesheets')
    <style>
        .description{
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
            line-height: 12px;
            font-size: 12px;
        }
    </style>
@endpush

@section('content')
    <div class="container-fluid bg-gradient-indigo">
        <div class="container py-5">
            <div class="row">
                <div class="col-12 p-2">
                    <h1 class="text-center text-white">Pencarian @if($isStore) Toko @else Produk @endif</h1>
                    <form action="{{ route('search') }}" action="get" class="mt-5">
                        <input type="hidden" name="store" value="{{ $isStore }}">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md pt-3">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-utensils"></i></span>
                                        </div>
                                        <input class="form-control" placeholder="Pesan apa aja..." type="text" name="q" id="input-q" value="{{ $q }}" autofocus>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto pl-md-1 pt-3">
                                    <button type="button" class="btn btn-white bg-gradient-white" data-toggle="collapse" data-target="#filter"><i class="fa fa-filter"></i></button>
                                    <button type="submit" class="btn btn-white"><i class="fa fa-search"></i><span class="d-none d-md-inline">Cari</span></button>
                                </div>
                                <div class="col-12 pt-3">
                                    <img src="{{ asset('img/icons/search-by-algolia-dark-background.svg') }}" alt="">
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="filter">
                            <div class="card card-body bg-white">
                                <h3 class="card-title"><i class="fa fa-filter fa-fw"></i> Filter</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-min">Minimal</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp. </span>
                                                </div>
                                                <input class="form-control" id="input-min" name="min" value="{{ $min }}" type="number" min="0">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="input-min">Maksimal</label>
                                            <div class="input-group input-group-merge">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text">Rp. </span>
                                                </div>
                                                <input class="form-control" id="input-max" name="max" value="{{ $max }}" type="number" min="0">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <a class="nav-link @if(!$isStore) active @endif" href="{{ route('search', ['q' => $q, 'min' => $min, 'max' => $max]) }}">Produk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link @if($isStore) active @endif" href="{{ route('search', ['q' => $q, 'store' => true]) }}">Toko</a>
                        </li>
                    </ul>

                </div>

                <div class="col-12 p-2">
                    @include('layouts.flash')
                </div>

                @foreach($products as $product)
                <div class="col-12 col-sm-6 col-md-4 p-2">
                    <x-product-card :product="$product" />
                </div>
                @endforeach

                @if(!$isStore)
                <div class="col-12">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>
                @endif

                @foreach($sellers as $seller)
                <div class="col-3 col-sm-2 p-2">
                    <x-seller-card :seller="$seller" />
                </div>
                @endforeach

                @if($isStore)
                <div class="col-12">
                    {{ $sellers->links('vendor.pagination.bootstrap-4') }}
                </div>
                @endif

                @if($products->isEmpty() && $sellers->isEmpty())
                <div class="col-12 py-4">
                    <p class="text-center text-white">Tidak ada yang ditemukan</p>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
