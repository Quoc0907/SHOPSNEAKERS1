@extends('layout.default')

@section('main')

<div class="container p-t-50 p-b-50">
    <h2 class="text-center m-b-30">Kết quả tìm kiếm cho: <b>{{ $query }}</b></h2>

    @if($products->isEmpty())
        <p class="text-center">Không tìm thấy sản phẩm nào.</p>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
                    <div class="block2">
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            
                            <!-- <img src="{{ asset('public/images/'.$product->image) }}" alt="IMG-PRODUCT"> -->
                           <img src="{{ asset($product->HINHANH) }}" alt="IMG-PRODUCT">
                            <div class="block2-overlay trans-0-4">
                                <div class="block2-btn-addcart w-size1 trans-0-4">
                                    <a href="{{ route('cart.add', $product->MASP) }}" 
                                       class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                       Add to Cart
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="block2-txt p-t-20">
                            <a href="{{ route('product.detail', $product->MASP) }}" class="block2-name dis-block s-text3 p-b-5">
                                {{ $product->TENSP }}
                            </a>
                            <span class="block2-price m-text6 p-r-5">${{ $product->GIA }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
