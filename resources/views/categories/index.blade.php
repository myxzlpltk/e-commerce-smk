@extends('layouts.console.app')

@section('title', 'Kategori')

@section('breadcrumbs', Breadcrumbs::render('manage.categories.index'))

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
@endpush

@section('actions')
    @can('create', App\Models\Category::class)
        <a href="{{ route('manage.categories.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-fw"></i> Tambah Data</a>
    @endcan
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center table-flush data-table" data-autonumber="true" id="datatable-basic">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Total Produk</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->products_count }} Produk</td>
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
                                    <button type="submit" class="table-action btn btn-link btn-delete" data-toggle="tooltip" title="Hapus" onclick="return window.confirm('Apakah anda yakin?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
@endpush
