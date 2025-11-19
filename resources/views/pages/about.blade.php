@extends('layout.default')

@section('main')

<!-- Banner About -->
<section class="bg-title-page p-t-50 p-b-40 flex-col-c-m" 
   style="background-image: url('{{ asset('public/images/banner-about.jpg') }}'); height: 630px; background-size: cover; background-position: center;">
    <h2 class="l-text2 t-center" style="color:white; text-shadow: 0 2px 5px rgba(0,0,0,0.4);">
        SHOP SNEAKERS
    </h2>
    <p class="m-text13 t-center" style="color:white; opacity:0.9;">
        Phong cách – Đẳng cấp – Chất riêng
    </p>
</section>

<!-- About Section -->
<section class="bgwhite p-t-60 p-b-60">
    <div class="container">
        <div class="row flex-w flex-sa">
            
            <!-- Left Image -->
            <div class="col-md-6 p-b-30">
                <img src="{{ asset('public/images/about-sneaker.jpg') }}" 
                    alt="Shop Sneakers" 
                    class="img-fluid shadow-lg"
                    style="border-radius: 15px;">
            </div>

            <!-- Right Content -->
            <div class="col-md-6 p-b-30">
                <h3 class="m-text26 p-b-20">
                    Giới thiệu về <strong>ShopSneakers</strong>
                </h3>

                <p class="s-text7 p-b-15">
                    ShopSneakers là cửa hàng chuyên cung cấp các dòng sneaker hot nhất thị trường,
                    từ những mẫu casual đơn giản đến các phiên bản limited dành riêng cho sneakerhead.
                </p>

                <p class="s-text7 p-b-15">
                    Chúng tôi luôn cập nhật xu hướng và mang đến sản phẩm chất lượng,
                    giúp bạn tự tin thể hiện phong cách cá nhân trong mọi khoảnh khắc.
                </p>

                <p class="s-text7 p-b-20">
                    Với cam kết hàng chính hãng, giá tốt và dịch vụ tận tâm –
                    ShopSneakers luôn mong muốn trở thành lựa chọn hàng đầu của bạn.
                </p>

                <a href="{{ route('home.index') }}" 
                   class="btn btn-dark rounded-pill"
                   style="padding: 10px 25px;">
                    Khám phá ngay →
                </a>
            </div>

        </div>
    </div>
</section>

<!-- Values Section -->
<!-- <section class="p-t-60 p-b-60 bg-light">
    <div class="container">
        <h3 class="l-text2 t-center p-b-40">
            Giá trị cốt lõi
        </h3>

        <div class="row text-center">
            
            <div class="col-md-4 p-b-30">
                <img src="{{ asset('public/icons/quality.png') }}" width="80" class="p-b-20">
                <h4 class="m-text25 p-b-10">Chính hãng 100%</h4>
                <p class="s-text7">Cam kết chỉ cung cấp sản phẩm chính hãng với đầy đủ hóa đơn & QR kiểm tra.</p>
            </div>

            <div class="col-md-4 p-b-30">
                <img src="{{ asset('public/icons/service.png') }}" width="80" class="p-b-20">
                <h4 class="m-text25 p-b-10">Dịch vụ tận tâm</h4>
                <p class="s-text7">Tư vấn nhanh chóng, hỗ trợ đổi trả linh hoạt và chăm sóc khách hàng 24/7.</p>
            </div>

            <div class="col-md-4 p-b-30">
                <img src="{{ asset('public/icons/trend.png') }}" width="80" class="p-b-20">
                <h4 class="m-text25 p-b-10">Luôn bắt kịp xu hướng</h4>
                <p class="s-text7">Liên tục cập nhật các mẫu sneaker mới nhất từ Nike, Adidas, Puma...</p>
            </div>

        </div>
    </div> -->
</section>

@endsection
