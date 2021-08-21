@extends('layouts.console.app')

@section('title', 'Tambah Penjual')

@section('breadcrumbs', Breadcrumbs::render('manage.sellers.create'))

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
            <form action="{{ route('manage.sellers.store') }}" method="post">
                @method('POST')
                @csrf

                <div class="form-group">
                    <label for="name">Nama Penjual <x-required/></label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan nama penjual" autofocus required>
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Alamat Email <x-required/></label>
                    <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan alamat email" autofocus required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Kata Sandi <x-required/></label>
                    <input type="text" id="password" name="password" class="form-control @error('password') is-invalid @enderror" value="{{ old('name') }}" placeholder="Masukkan kata sandi" autofocus required>
                    @error('password')
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
