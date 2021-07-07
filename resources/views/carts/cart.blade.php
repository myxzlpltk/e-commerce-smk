@extends('layouts.default.app')

@section('title', 'Keranjang')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.min.css') }}">
@endpush

@section('content')

    <div class="container">
        @include('layouts.flash')
    </div>

    <section class="cart_area py-5">
        <div class="container">
            <h1 class="text-center">Keranjang Saya</h1>

            @forelse($carts as $list)
            @php $seller = $list->first()->product->seller @endphp
            <div class="cart_inner">
                <a href="{{ route('sellers.show', $seller) }}">
                    <div class="d-flex w-100 align-items-center mb-3">
                        <img src="{{ asset('storage/logos/'.$seller->logo) }}" alt="Image placeholder" class="img-fluid mr-2" style="max-height: 50px;" />
                        <h5 class="mb-1">{{ $seller->store_name }}</h5>
                    </div>
                </a>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Produk</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Qty</th>
                            <th scope="col">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $cart)
                        <tr>
                            <td>
                                <div class="media">
                                    <div class="d-flex">
                                        <img src="{{ asset("storage/products/{$cart->product->image}") }}" alt="" style="max-height: 50px;">
                                    </div>
                                    <div class="media-body">
                                        <p>{{ $cart->product->name }}</p>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <h5>{{ App\Helpers\Helper::idr($cart->product->price) }}</h5>
                            </td>
                            <td style="width: 10%">
                                <form action="{{ route('carts.update', $cart) }}" method="post">
                                    @csrf
                                    @method('PATCH')

                                    <input type="hidden" value="{{ $cart->id }}" name="id">
                                    @if(old('id') == $cart->id)
                                        <div class="form-group mb-0">
                                            <input type="number" value="{{ old('qty', $cart->qty) }}" class="form-control form-control-sm text-center @error('qty') is-invalid @enderror" name="qty" min="0" max="{{ $cart->product->stock }}" required>
                                            @error('qty')
                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    @else
                                        <div class="form-group mb-0">
                                            <input type="number" value="{{ $cart->qty }}" class="form-control form-control-sm text-center" name="qty" min="0" max="{{ $cart->product->stock }}" required>
                                        </div>
                                    @endif
                                </form>
                            </td>
                            <td>
                                <h5>{{ App\Helpers\Helper::idr($cart->subtotal) }}</h5>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <h5>Total</h5>
                            </td>
                            <td>
                                <h5>{{ App\Helpers\Helper::idr($list->sum('subtotal')) }}</h5>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="checkout_btn_inner float-right">
                        <a class="btn_1 checkout_btn_1" href="{{ route('orders.create', $seller) }}">Pesan</a>
                    </div>

                </div>
            </div>
            @if(!$loop->last) <hr class="mx-3 my-5"/> @endif
            @empty
            <div class="text-center py-5">
                <i class="fa fa-shopping-cart fa-4x animated rubberBand mb-3"></i>
                <h3 class="mb-4">Keranjang kamu masih kosong...</h3>
                <a href="{{ route('search') }}" class="btn btn-white">Saya ingin belanja barang</a>
            </div>
            @endforelse
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            $('[name="qty"]').each(function (){
                var qty = $(this).val();
                $(this).blur(function (){
                    if(qty != $(this).val()){
                        $(this).closest('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
