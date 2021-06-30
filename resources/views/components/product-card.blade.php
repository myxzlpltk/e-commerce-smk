<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6">
    <div class="single-popular-items mb-50 text-center">
        <div class="popular-img">
            <img src="{{ asset("storage/products/{$product->image}") }}" alt="{{ $product->name }}">
            <div class="img-cap">
                @if($product->stock > 0)
                <a href="{{ route('carts.add', $product) }}"><span><i class="fa fa-cart-plus fa-fw"></i> Tambah ke Keranjang</span></a>
                @else
                <span>Stok Habis</span>
                @endif
            </div>
        </div>
        <div class="popular-caption">
            <h3><a href="{{ route('sellers.show', $product->seller_id) }}#products-{{ $product->id }}">{{ $product->name }}</a></h3>
            <span>
                @if($product->discount > 0)
                    <del class="text-danger small">{{ App\Helpers\Helper::idr($product->price) }}</del>
                @endif
                {{ App\Helpers\Helper::idr($product->price_after_discount) }}
            </span>
        </div>
    </div>
</div>
