@extends('layouts.console.app')

@section('title', 'Tambah Kategori')

@section('breadcrumbs', Breadcrumbs::render('manage.categories.create'))

@push('stylesheets')
@endpush

@section('actions')
@endsection

@section('content')
    <div class="card">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-clipboard-list fa-fw"></i> Formulir</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('manage.categories.store') }}" method="post">
                @method('POST')
                @csrf

                <div class="form-group">
                    <label for="input-name">Nama Kategori</label>
                    <input type="text" id="input-name" name="category_name" class="form-control @error('category_name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama kategori" autofocus required>
                    @error('category_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-save fa-fw"></i> Simpan</button>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
