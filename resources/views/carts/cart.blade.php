@extends('layouts.default.app')

@section('title', 'Keranjang')

@push('stylesheets')
    <link rel="stylesheet" href="{{ asset('vendor/animate.css/animate.min.css') }}">
@endpush

@section('content')
    <div class="container-fluid bg-gradient-indigo">
        <div class="container py-5">
            @include('layouts.flash')

            <h1 class="text-center text-white">Keranjang Saya</h1>

            @if($carts->count())
            <div class="card mt-4">
                @foreach($carts as $list)
                @php $seller = $list->first()->product->seller @endphp
                <div class="p-3">
                    <a href="{{ route('sellers.show', $seller) }}">
                        <div class="d-flex w-100 align-items-center mb-3">
                            <img src="{{ asset('storage/logos/'.$seller->logo) }}" alt="Image placeholder" class="avatar avatar-sm mr-2" />
                            <h5 class="mb-1">{{ $seller->store_name }}</h5>
                        </div>
                    </a>
                    <div class="table-responsive">
                        <table class="table table-sm align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Jumlah</th>
                                    <th>Subtotal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($list as $cart)
                                <tr>
                                    <td>{{ $cart->product->name }}</td>
                                    <td>{{ App\Helpers\Helper::idr($cart->product->price) }}</td>
                                    <td style="width: 10%">
                                        <form action="{{ route('carts.update', $cart) }}" method="post">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" value="{{ $cart->id }}" name="id">
                                            @if(old('id') == $cart->id)
                                            <div class="form-group mb-0">
                                                <input type="number" value="{{ old('qty', $cart->qty) }}" class="form-control form-control-sm text-center @error('qty') is-invalid @enderror" name="qty" min="1" max="{{ $cart->product->stock }}" required>
                                                @error('qty')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            @else
                                            <div class="form-group mb-0">
                                                <input type="number" value="{{ $cart->qty }}" class="form-control form-control-sm text-center" name="qty" min="1" max="{{ $cart->product->stock }}" required>
                                            </div>
                                            @endif
                                        </form>
                                    </td>
                                    <td>{{ App\Helpers\Helper::idr($cart->subtotal) }}</td>
                                    <td>
                                        <form class="d-inline" action="{{ route('carts.destroy', $cart) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <a href="javascript:void(0)" class="table-action btn-delete" data-toggle="tooltip" title="Hapus">
                                                <i class="fas fa-trash text-red"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-right">Total</th>
                                    <td>{{ App\Helpers\Helper::idr($list->sum('subtotal')) }}</td>
                                    <td>
                                        <a href="{{ route('orders.create', $seller) }}" class="btn btn-primary btn-sm">Bayar</a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                @if(!$loop->last) <hr class="mx-3 my-0"/> @endif
                @endforeach
            </div>
            @else
            <div class="text-center py-5">
                <i class="fa fa-shopping-cart fa-4x animated rubberBand text-white mb-3"></i>
                <h3 class="text-white mb-4">Keranjang kamu masih kosong...</h3>
                <a href="{{ route('search') }}" class="btn btn-white">Saya ingin belanja barang</a>
            </div>
            @endif
        </div>
    </div>
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
