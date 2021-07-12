@extends('layouts.console.app')

@section('title', 'Lihat Produk')

@section('breadcrumbs', Breadcrumbs::render('manage.products.show', $product))

@push('stylesheets')
@endpush

@section('actions')
    @can('update', $product)
        <a href="{{ route('manage.products.edit', $product) }}" class="btn btn-warning btn-sm"><i class="fa fa-edit fa-fw"></i> Edit</a>
    @endcan
    @can('delete', $product)
        <form class="d-inline" action="{{ route('manage.products.destroy', $product) }}" method="post">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return window.confirm('Apakah anda yakin?')"><i class="fa fa-trash fa-fw"></i> Hapus</button>
        </form>
    @endcan
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="card mb-3">
                <img src="{{ asset('storage/products/'.$product->image) }}" alt="" class="card-img-top">

                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="small text-muted">{{ $product->description }}</p>
                    <p class="card-text font-weight-bold mb-0">{{ App\Helpers\Helper::idr($product->priceAfterDiscount) }}</p>
                    @if($product->discount > 0)
                    <span class="badge badge-warning badge-lg">Diskon {{ $product->discount }}% Off</span>
                    @endif
                </div>
            </div>

            @can('update', $product)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="h3 card-title">Stok Tersedia</h5>
                    <form action="{{ route('manage.products.update-stock', $product) }}" method="post">
                        @csrf
                        @method('PATCH')

                        <div class="form-group input-stock">
                            <div class="input-group input-group-sm">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-minus"></i></button>
                                </div>
                                <input type="number" value="{{ old('stock', $product->stock) }}" class="form-control text-center @error('stock') is-invalid @enderror" name="stock" required>
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            @error('stock')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Perbarui</button>
                    </form>
                </div>
            </div>
            @endcan
        </div>
        <div class="col-md-8 col-lg-9">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Informasi Produk</h6>
                </div>
                <div class="card-body">
                    <dl>
                        @can('isAdmin')
                        <dt>Nama Toko</dt>
                        <dd>{{ $product->seller->store_name }}</dd>
                        @endcan
                        <dt>Nama</dt>
                        <dd>{{ $product->name }} <span class="badge badge-primary">{{ $product->category->name }}</span></dd>
                        <dt>Deskripsi</dt>
                        <dd>{{ $product->description }}</dd>
                        <dt>Harga</dt>
                        <dd>{{ App\Helpers\Helper::idr($product->price) }}</dd>
                        @can('isAdmin')
                        <dt>Stok</dt>
                        <dd>{{ $product->stock }} Tersisa</dd>
                        @endcan
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            $('.input-stock .input-group-prepend button').click(function(){
                $('.input-stock input').val(Math.max(0, parseInt($('.input-stock input').val()) - 1));
            })
            $('.input-stock .input-group-append button').click(function(){
                $('.input-stock input').val(parseInt($('.input-stock input').val()) + 1);
            })
        })
    </script>
@endpush
