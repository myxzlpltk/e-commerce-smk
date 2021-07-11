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
                    <h1 class="text-center">Pencarian Toko</h1>
                    <form action="{{ route('search') }}" action="get" class="mt-5">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-12 col-md pt-3">
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-search fa-fw"></i></span>
                                        </div>
                                        <input class="form-control form-control-lg" placeholder="Pesan apa aja..." type="text" name="q" id="input-q" value="{{ $q }}" autofocus>
                                    </div>
                                </div>
                                <div class="col-12 col-md-auto pl-md-1 pt-3">
                                    <button type="button" class="btn btn_3" data-toggle="collapse" data-target="#filter" style="padding-top: 16px; padding-bottom: 16px;"><i class="fa fa-filter"></i></button>
                                </div>
                                <div class="col-12 col-md-auto pl-md-1 pt-3">
                                    <button type="submit" class="btn btn_1" style="padding-top: 16px; padding-bottom: 16px;"><i class="fa fa-search fa-fw"></i> <span class="d-none d-md-inline">Cari</span></button>
                                </div>
                            </div>
                        </div>

                        <div class="collapse" id="filter">
                            <div class="card card-body bg-white mb-3">
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
                </div>

                <div class="col-12 p-2">
                    @include('layouts.flash')
                </div>

                <div class="col-12 popular-items">
                    <div class="row">
                        @foreach($products as $product)
                        <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>

                <div class="col-12">
                    {{ $products->links('vendor.pagination.bootstrap-4') }}
                </div>

                @if($products->isEmpty())
                <div class="col-12 py-4">
                    <p class="text-center">Tidak ada yang ditemukan</p>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
