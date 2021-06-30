@extends('layouts.console.app')

@section('title', 'Produk')

@section('breadcrumbs', Breadcrumbs::render('manage.products.index'))

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('card-stats')
@endsection

@section('header')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mb-0">Data Produk</h3>
            @can('create', App\Models\Product::class)
            <a href="{{ route('manage.products.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
            @endcan
        </div>
        <div class="table-responsive py-4">
            <table class="table align-items-center table-flush" id="datatable-basic">
                <thead class="thead-light">
                    <tr>
                        @can('isAdmin')
                        <th>Toko</th>
                        @endcan
                        <th>Nama</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        @can('isAdmin')
                        <td><a href="#">{{ $product->seller->store_name }}</a></td>
                        @endcan
                        <td>
                            <span class="d-block">{{ $product->name }}</span>
                            <span class="text-primary">{{ $product->category->name }}</span>
                        </td>
                        <td>
                            @if($product->discount > 0)
                                <small class="d-block">
                                    <del class="text-danger">{{ App\Helpers\Helper::idr($product->price) }}</del>
                                    <span class="text-info" data-toggle="tooltip" title="Diskon">({{ $product->discount }}%)</span>
                                </small>
                            @endif
                            {{ App\Helpers\Helper::idr($product->priceAfterDiscount) }}
                        </td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <a href="{{ route('manage.products.show', $product) }}" class="table-action" data-toggle="tooltip" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
@endpush
