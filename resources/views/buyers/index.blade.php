@extends('layouts.console.app')

@section('title', 'Pembeli')

@section('breadcrumbs', Breadcrumbs::render('manage.buyers.index'))

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endpush

@section('content')
    <div class="card mb-3">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center table-flush data-table" data-autonumber="true" id="datatable-basic">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($buyers as $user)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ asset('storage/avatars/'.$user->avatar) }}" class="avatar rounded-circle mr-3" alt="avatar">
                                {{ $user->name }}
                            </td>
                            <td>
                                {{ $user->email }}
                                @if($user->hasVerifiedEmail())
                                    <i class="fas fa-check-circle fa-fw text-primary" data-toggle="tooltip" title="Terverifikasi"></i>
                                @else
                                    <i class="fas fa-times-circle fa-fw text-danger" data-toggle="tooltip" title="Tidak Terverifikasi"></i>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('manage.users.show', $user) }}" class="table-action" data-toggle="tooltip" title="Lihat">
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
