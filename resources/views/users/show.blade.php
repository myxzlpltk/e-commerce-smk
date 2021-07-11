@extends('layouts.console.app')

@section('title', 'Data '.ucwords(__($user->role)))

@section('breadcrumbs', Breadcrumbs::render('manage.users.show', $user))

@push('stylesheets')
@endpush

@section('actions')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
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
                    </div>
                </div>
            </div>

            @if($user->isSeller && $user->seller)
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

        @if($user->isSeller)
        <div class="col-12">
            <div class="card mb-3">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-history fa-fw"></i> Riwayat Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush data-table" data-autonumber="true" id="datatable-basic">
                            <thead>
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>Pembeli</th>
                                <th>Total</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($user->seller->successOrders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->created_at->format('d M Y') }}</td>
                                    <td>
                                        <span>{{ $order->buyer->user->name }}</span>
                                        <small class="d-block text-muted">{{ $order->address }}</small>
                                    </td>
                                    <td>{{ App\Helpers\Helper::idr($order->total) }}</td>
                                    <td>
                                        <a href="{{ route('manage.orders.show', $order) }}" class="table-action" data-toggle="tooltip" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush
