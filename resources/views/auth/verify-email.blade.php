@extends('layouts.default.app')

@section('title', 'Masuk')

@section('content')
    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">

                @include('layouts.flash')

                <h1 class="text-center mb-4">Verifikasi Alamat Email</h1>

                <div class="card shadow border-0 mb-0">
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
