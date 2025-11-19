@extends('layout.default')

@section('main')
<div class="container p-t-50 p-b-50">

    <h2 class="text-center m-b-30">Shop</h2>

    <div class="row">
        @foreach($products as $product)
        <div class="col-sm-6 col-md-4 col-lg-3 p-b-50">
            <div class="block2">
                <div class="block2-img wrap-pic-w of-hidden pos-relative">
                    <a href="{{ route('product.detail', ['product' => $product->MASP]) }}">
                        <img src="{{ $product->HINHANH }}" alt="{{ $product->TENSP }}">
                    </a>

                    <div class="block2-overlay trans-0-4">
                        <div class="block2-btn-addcart w-size1 trans-0-4">

                            {{-- Form chọn size & color, dùng GET để add + checkout --}}
                            <form action="{{ route('cart.add.get', $product->MASP) }}" method="get">

                                <div class="p-b-5">
                                    <select name="size" class="form-control">
                                        <option value="36">36</option>
                                        <option value="37">37</option>
                                        <option value="38">38</option>
                                        <option value="39">39</option>
                                    </select>
                                </div>
                                <div class="p-b-5">
                                    <select name="color" class="form-control">
                                        <option value="Red">Red</option>
                                        <option value="Blue">Blue</option>
                                        <option value="Green">Green</option>
                                    </select>
                                </div>
                                <button type="submit" 
                                        class="flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4">
                                    Buy Now
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="block2-txt p-t-20">
                    <a href="{{ route('product.detail', ['product' => $product->MASP]) }}" 
                       class="block2-name dis-block s-text3 p-b-5">
                        {{ $product->TENSP }}
                    </a>
                    <span class="block2-price m-text6 p-r-5">
                        {{ number_format($product->GIA) }} &#8363;
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
