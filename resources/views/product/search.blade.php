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
                        <!-- Hình sản phẩm -->
                        <div class="block2-img wrap-pic-w of-hidden pos-relative">
                            <img src="{{ asset($product->HINHANH) }}" alt="IMG-PRODUCT">

                            <!-- Overlay 2 nút nằm dưới hình -->
                            <div class="block2-overlay trans-0-4 d-flex flex-column justify-content-end align-items-center pb-3 gap-2">
                                <!-- Add to Cart AJAX -->
                                <!-- <a href="#"
                                   class="add-to-cart-btn flex-c-m size1 bg4 bo-rad-23 hov1 s-text1 trans-0-4"
                                   data-id="{{ $product->MASP }}"
                                   data-size="36"
                                   data-color="Default">
                                    Add to Cart
                                </a> -->

                                <!-- Mua ngay: chuyển Payment -->
                                <a href="{{ route('cart.addAndCheckout', $product->MASP) }}?size=36&color=Default"
                                   class="flex-c-m size1 bg1 bo-rad-23 hov1 s-text1 trans-0-4">
                                   Mua Ngay
                                </a>
                            </div>
                        </div>

                        <!-- Tên sản phẩm + Giá nằm ngoài overlay -->
                        <div class="block2-txt p-t-20 text-center">
                            <a href="{{ route('product.detail', $product->MASP) }}" class="block2-name dis-block s-text3 p-b-5">
                                {{ $product->TENSP }}
                            </a>
                            <span class="block2-price m-text6">${{ $product->GIA }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.add-to-cart-btn');

    buttons.forEach(btn => {
        btn.addEventListener('click', function(e){
            e.preventDefault();

            const product_id = this.dataset.id;
            const size = this.dataset.size;
            const color = this.dataset.color;

            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                body: JSON.stringify({
                    product_id: product_id,
                    size: size,
                    color: color,
                    quantity: 1
                })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success){
                    alert(data.message);
                    // Cập nhật số giỏ hàng (nếu có element .cart-count)
                    const cartCountElem = document.querySelector('.cart-count');
                    if(cartCountElem) cartCountElem.textContent = data.cart_count;
                } else {
                    alert(data.message);
                }
            })
            .catch(err => console.error(err));
        });
    });
});
</script>
@endsection
