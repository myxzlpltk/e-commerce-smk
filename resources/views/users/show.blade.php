@extends('layouts.console.app')

@section('title', 'Data '.ucwords(__($user->role)))

@section('breadcrumbs', Breadcrumbs::render('manage.users.show', $user))

@push('stylesheets')
@endpush

@section('actions')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-lg-3">
            <div class="card mb-3">
                <div class="card-body">
                    <img src="{{ asset('storage/avatars/'.$user->avatar) }}" class="rounded-circle img-center img-fluid shadow mx-auto d-block" style="width: 140px;">
                    <div class="pt-4 text-center">
                        <h5 class="title">
                            <span class="d-block mb-1">{{ $user->name }}</span>
                            <small class="font-weight-light text-muted">{{ __($user->role) }}</small>
                        </h5>
                        <div class="mt-3">
                            @empty($user->google_email)
                                <button type="button" class="btn btn-sm btn-danger btn-block mr-4"><i class="fab fa-google fa-fw"></i> Tidak Terhubung</button>
                            @else
                                <hr/>
                                <p class="card-title font-weight-bold">Akun Google</p>
                                <img src="{{ $user->google_avatar }}" alt="" class="avatar rounded-circle" data-toggle="tooltip" title="{{ $user->google_email }}">
                                <p>{{ $user->google_name }}</p>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>

            @if($user->isSeller)
                @if($user->seller)
                    <div class="card mb-3 card-profile">
                        <img src="{{ asset('storage/banners/'.$user->seller->banner) }}" alt="Banner Toko" class="card-img-top">

                        <div class="card-body">
                            <div class="d-flex justify-content-end align-items-center">

                                <div class="text-center ml-2">
                                    <h5>{{ $user->seller->store_name }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endif
        </div>
        <div class="col-md-6 col-lg-9">
            <div class="card mb-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-info-circle fa-fw"></i> Data Profil</h6>
                </div>
                <div class="card-body">
                    <h5 class="text-muted">Informasi Pengguna</h5>
                    <dl>
                        <div class="row">
                            <div class="col-md-6">
                                <dt>Nama Lengkap</dt>
                                <dd>{{ $user->name }}</dd>
                            </div>
                            <div class="col-md-6">
                                <dt>Email address</dt>
                                <dd>
                                    {{ $user->email }}
                                    @if($user->hasVerifiedEmail())
                                        <i class="fas fa-check-circle fa-fw text-primary" data-toggle="tooltip" title="Terverifikasi"></i>
                                    @else
                                        <i class="fas fa-times-circle fa-fw text-danger" data-toggle="tooltip" title="Tidak Terverifikasi"></i>
                                    @endif
                                </dd>
                            </div>
                        </div>
                    </dl>

                    <hr class="my-2"/>

                    <h5 class="text-muted ">Informasi {{ __($user->role) }}</h5>
                    <dl>
                        <div class="row">
                            <div class="col-md-12">
                                @if($user->isSeller)
                                    <dt>Nama Toko</dt>
                                    <dd>{{ optional($user->userable)->store_name ?? '-' }}</dd>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <dt>Alamat Lengkap</dt>
                                <dd>{{ optional($user->userable)->address ?? '-' }}</dd>
                            </div>
                            <div class="col-md-6">
                                <dt>Nomor HP</dt>
                                <dd>+62{{ optional($user->userable)->phone_number ?? '-' }}</dd>
                            </div>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
