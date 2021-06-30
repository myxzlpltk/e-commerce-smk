@extends('layouts.console.app')

@section('title', 'Kategori')

@section('breadcrumbs', Breadcrumbs::render('manage.categories.index'))

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('card-stats')
@endsection

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="mb-0">Data Kategori</h3>
            @can('create', App\Models\Category::class)
            <a href="{{ route('manage.categories.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
            @endcan
        </div>
        <div class="table-responsive py-4">
            <table class="table align-items-center table-flush" id="datatable-basic">
                <thead class="thead-light">
                <tr>
                    <th>Nama</th>
                    <th>Total Produk</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->products->count() }} Produk</td>
                        <td>
                            @can('update', $category)
                            <a href="{{ route('manage.categories.edit', $category) }}" class="table-action" data-toggle="tooltip" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @endcan

                            @can('delete', $category)
                            <form class="d-inline" action="{{ route('manage.categories.destroy', $category) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <a href="javascript:void(0)" class="table-action btn-delete" data-toggle="tooltip" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </form>
                            @endcan
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
