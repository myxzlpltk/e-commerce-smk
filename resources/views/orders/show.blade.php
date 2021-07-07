@extends('layouts.default.app')

@section('title', 'Informasi Pemesanan')

@push('stylesheets')
@endpush

@section('content')
    <div class="container-fluid bg-gradient-info">
        <div class="container py-5">
            @include('layouts.flash')

            <h1 class="text-center mb-4">Detail Pesanan</h1>

            @if($order->status_code == \App\Models\Order::ORDER_WAITING)
                <div class="alert alert-info">
                    Hubungi penjual untuk melanjutkan pemesanan
                </div>
            @endif

            <div class="row">
                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <dl>
                                <dt>Nomor Pesanan</dt>
                                <dd>{{ $order->no_invoice }}</dd>
                                <dt>Status</dt>
                                <dd>{{ $order->status }}</dd>
                                <dt>Nama Toko</dt>
                                <dd>
                                    <a href="{{ route('sellers.show', $order->seller) }}" class="text-dark">{{ $order->seller->store_name }}</a>
                                    <p class="text-dark mb-0">Telp: +62{{ $order->seller->phone_number }}</p>
                                </dd>
                                <dt>Tanggal Pembelian</dt>
                                <dd>{{ $order->created_at->format('d M Y H:i') }}</dd>
                            </dl>
                        </div>

                        @can('cancel', $order)
                        <div class="card-footer">
                            <form class="d-inline" action="{{ route('order.cancel', $order) }}" method="post">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-danger btn-sm py-3 btn-alert" onclick="return window.confirm('Apakah anda yakin?')"><i class="fa fa-ban fa-fw"></i> Batalkan Pesanan</button>
                            </form>
                        </div>
                        @endcan
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="mb-3"><i class="fa fa-user-tie fa-fw"></i> Info Pembeli</h4>
                            <p class="mb-0">Ditujukan kepada <b class="font-weight-bold">{{ $order->buyer->user->name }}</b></p>
                            <p class="mb-0">{{ $order->buyer->address }}</p>
                            <p class="mb-0">Telp: +62{{ $order->buyer->phone_number }}</p>
                        </div>
                    </div>

                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="mb-3"><i class="fa fa-history fa-fw"></i> Pelacakan</h4>

                            @foreach($order->tracks->sortBy('created_at') as $track)
                                <div class="row">
                                    <div class="col-auto">
                                        <small class="mb-0">{{ $track->created_at->format('d F Y H:i') }}</small>
                                    </div>
                                    <div class="col">
                                        <p class="mb-0">{{ $track->status }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="mb-3"><i class="fa fa-list fa-fw"></i> Daftar Produk</h4>
                    @foreach($order->details as $detail)
                        <x-order-detail-product :detail="$detail" />
                    @endforeach
                    <p>Total belanja <span class="font-weight-bold text-dark">{{ App\Helpers\Helper::idr($order->total) }}</span></p>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
@endpush
