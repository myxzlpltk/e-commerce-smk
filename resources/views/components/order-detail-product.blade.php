<div class="row align-items-center mb-1">
    <div class="col-auto">
        <img src="{{ asset('storage/products/'.$detail->product->image) }}" alt="" class="img-fluid rounded" style="height: 50px;">
    </div>
    <div class="col">
        <h5 class="mb-0">{{ $detail->product->name }}</h5>
        <small>{{ $detail->qty }} Produk x {{ App\Helpers\Helper::idr($detail->price_after_discount) }}</small>
    </div>
    <div class="col border-left">
        <h5 class="mb-0">Total Harga Produk</h5>
        <h6 class="mb-0 text-primary"><strong>{{ App\Helpers\Helper::idr($detail->subtotal) }}</strong></h6>
    </div>
    @if($withAction)
    <div class="col">
        <a href="{{ route('carts.add', $detail->product) }}" class="btn btn-primary btn_1 py-2 btn-sm"><i class="fa fa-cart-plus fa-fw"></i> Beli Lagi</a>
    </div>
    @endif
</div>
