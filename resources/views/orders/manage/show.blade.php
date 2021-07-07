@extends('layouts.console.app')

@section('title', 'Detail Transaksi')

@section('breadcrumbs', Breadcrumbs::render('manage.orders.show', $order))

@push('stylesheets')
@endpush

@section('actions')
@endsection

@section('content')
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
                            <a href="{{ route('sellers.show', $order->seller) }}">{{ $order->seller->store_name }}</a>
                            <p class="mb-0">Telp: +62{{ $order->seller->phone_number }}</p>
                        </dd>
                        <dt>Tanggal Pembelian</dt>
                        <dd>{{ $order->created_at->format('d M Y H:i') }}</dd>
                    </dl>
                </div>
                @can('delivery-complete', $order)
                <div class="card-footer">
                    <form class="d-inline" action="{{ route('manage.order.delivery-complete', $order) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success btn-sm btn-alert" onclick="return window.confirm('Apakah anda yakin?')"><i class="fa fa-check fa-fw"></i> Pesanan Telah Selesai</button>
                    </form>
                </div>
                @endcan
                @can('cancel', $order)
                <div class="card-footer">
                    <form class="d-inline" action="{{ route('manage.order.cancel', $order) }}" method="post">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-danger btn-sm btn-alert" onclick="return window.confirm('Apakah anda yakin?')"><i class="fa fa-ban fa-fw"></i> Batalkan Pesanan</button>
                    </form>
                </div>
                @endcan
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-user-tie fa-fw"></i> Info Pembeli</h6>
                </div>
                <div class="card-body">
                    <p class="mb-0">Dikirim kepada <b class="font-weight-bold">{{ $order->buyer->user->name }}</b></p>
                    <p class="mb-0">{{ $order->buyer->address }}</p>
                    <p class="mb-0">Telp: +62{{ $order->buyer->phone_number }}</p>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-history fa-fw"></i> Pelacakan</h6>
                </div>
                <div class="card-body">
                    @foreach($order->tracks->sortBy('created_at') as $track)
                        <div class="row">
                            <div class="col-auto">
                                <p class="mb-0">{{ $track->created_at->format('d F Y H:i') }}</p>
                            </div>
                            <div class="col">
                                <p class="text-dark mb-0">{{ $track->status }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fa fa-list fa-fw"></i> Daftar Produk</h6>
        </div>
        <div class="card-body">
            @foreach($order->details as $detail)
                <x-order-detail-product :detail="$detail" :action="false" />
            @endforeach
            <p>Total belanja <span class="font-weight-bold text-orange">{{ App\Helpers\Helper::idr($order->total) }}</span></p>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
