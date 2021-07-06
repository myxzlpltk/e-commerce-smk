@extends('layouts.console.app')

@section('title', 'Transaksi')

@section('breadcrumbs', Breadcrumbs::render('manage.orders.index'))

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('actions')
@endsection

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center table-flush data-table" data-autonumber="true" id="datatable-basic">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Tanggal</th>
                            <th>Pembeli</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $order->created_at->format('d M Y') }}</td>
                            <td>
                                <span>{{ $order->buyer->user->name }}</span>
                                <small class="d-block text-muted">{{ $order->address }}</small>
                            </td>
                            <td>{{ App\Helpers\Helper::idr($order->total) }}</td>
                            <td>{{ $order->status }}</td>
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
@endsection

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush
