@extends('layouts.default.app')

@section('title', 'Masuk')

@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                        <span class="alert-text">{{ __(session('status')) }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <span class="alert-icon"><i class="fa fa-times-circle"></i></span>
                        <span class="alert-text">{{ session('error') }}</span>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="card bg-secondary border-0 mb-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form action="{{ route('verification.send') }}" method="POST" class="text-center">
                            @csrf
                            <p class="text-lead mb-0">Apabila kamu belum menerima email. Silahkan kirim ulang email konfirmasi</p>
                            <button type="submit" class="btn btn-primary my-4">Kirim Ulang</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
