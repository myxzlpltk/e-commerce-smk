@extends('layouts.default.app')

@section('title', 'Pendaftaran')

@push('stylesheets')
@endpush

@section('content')
    <section class="login_part section_padding ">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_text text-center">
                        <div class="login_part_text_iner">
                            <h2>Sudah punya Akun?</h2>
                            <p>There are advances being made in science and technology
                                everyday, and a good example of this is the</p>
                            <a href="{{ route('login') }}" class="btn_3">Masuk</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="login_part_form">
                        <div class="login_part_form_iner">
                            <h3>Selamat Datang! <br> Silahkan Mendaftar</h3>

                            @include('layouts.flash')

                            <form class="row contact_form" action="{{ route('register') }}" method="post" novalidate="novalidate">
                                @csrf
                                <div class="col-md-12 form-group p_star">
                                    <input class="form-control" placeholder="Nama Lengkap" type="text" name="name" value="{{ old('name') }}" autofocus required>
                                    @error('name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input class="form-control" placeholder="Email" type="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input class="form-control" placeholder="Kata Sandi" type="password" name="password" required>
                                    @error('password')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12 form-group p_star">
                                    <input class="form-control" placeholder="Ketik Ulang Kata Sandi" type="password" name="password_confirmation" required>
                                    @error('password_confirmation')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RECAPTCHA_SITE_KEY') }}"></div>
                                </div>
                                <div class="col-md-12 form-group">
                                    <button type="submit" value="submit" class="btn_3">Mendaftar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
@endpush
