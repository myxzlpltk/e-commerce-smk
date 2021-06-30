@extends('layouts.default.app')

@section('title', $seller->store_name)

@push('stylesheets')
@endpush

@section('content')
    <!-- Hero Area Start-->
    <div class="slider-area ">
        <div class="single-slider slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap text-center">
                            <h2>Unit Usaha</h2>
                            <h2>{{ $seller->store_name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Hero Area End-->

    <section class="popular-items latest-padding">
        <div class="container">
            <div class="row product-btn justify-content-between mb-40">
                <div class="properties__button">
                    <!--Nav Button  -->
                    <nav>
                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                            @foreach($seller->categories as $category)
                            <a class="nav-item nav-link @if($loop->first) active @endif" id="nav-{{ Str::slug($category->name) }}-tab" data-toggle="tab" href="#nav-{{ Str::slug($category->name) }}">{{ $category->name }}</a>
                            @endforeach
                        </div>
                    </nav>
                    <!--End Nav Button  -->
                </div>
            </div>
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                @foreach($seller->categories as $category)
                <div class="tab-pane fade @if($loop->first) show active @endif" id="nav-{{ Str::slug($category->name) }}">
                    <div class="row">
                        @foreach($category->products as $product)
                        <x-product-card :product="$product" />
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @include('partials.shop-method')
@endsection

@push('scripts')
@endpush
