@extends('layout.default')

@section('main')

<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="{{ route('home.index') }}" class="s-text16">Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <a href="{{ route('blog') }}" class="s-text16">Blog
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>

    <span class="s-text17">Detail</span>
</div>


<section class="blog-detail bgwhite p-t-60 p-b-60">
    <div class="container">

        @php
            $posts = [
                1 => [
                    'title' => 'Top 5 Đôi Sneaker Hot Nhất 2025 – Ai Cũng Muốn Sở Hữu',
                    'content' => "
                        <p>Năm 2025 là một năm bùng nổ của thị trường sneaker với hàng loạt phối màu và phiên bản giới hạn khiến dân chơi giày đứng ngồi không yên. Dưới đây là TOP 5 đôi giày đáng mua nhất 2025.</p>

                        <h4>1. Nike Air Jordan 1 Retro High OG</h4>
                        <p>Một tượng đài trong làng sneaker. Form đẹp, phối màu dễ mang và giá trị sưu tầm cực cao.</p>

                        <h4>2. Adidas Yeezy 350 V2</h4>
                        <p>Thiết kế êm, nhẹ, cực thoải mái. Yeezy luôn là lựa chọn hàng đầu cho phong cách streetwear.</p>

                        <h4>3. Nike Air Force 1 '07</h4>
                        <p>Đôi giày quốc dân, dễ phối đồ, phù hợp mọi outfit từ học sinh đến dân công sở.</p>

                        <h4>4. Converse Chuck Taylor 1970s</h4>
                        <p>Thiết kế cổ điển, bền bỉ, phù hợp mọi phong cách vintage.</p>

                        <h4>5. Puma Suede Classic</h4>
                        <p>Một biểu tượng của retro sneaker, chất liệu suede mềm, màu sắc đẹp.</p>

                        <p>➡ Nếu bạn đang tìm đôi sneaker đầu tiên, 5 gợi ý trên là lựa chọn không thể sai!</p>
                    ",
                    'image' => 'sneaker1.jpg'
                ],
                
                2 => [
                    'title' => 'Cách Phân Biệt Giày Thật – Giả (Real – Fake) Dễ Nhất Cho Người Mới',
                    'content' => "
                        <p>Thị trường giày giả ngày càng tinh vi. Nếu bạn muốn mua sneaker chính hãng, đây là những cách phân biệt đơn giản mà hiệu quả.</p>

                        <h4>1. Kiểm tra hộp và tem</h4>
                        <p>Giày thật có tem rõ ràng, chữ sắc nét, mã code tra được trên trang hãng.</p>

                        <h4>2. Mùi giày</h4>
                        <p>Giày fake thường có mùi keo nồng, giày thật gần như không có mùi.</p>

                        <h4>3. Chất liệu</h4>
                        <p>Da hoặc vải của giày thật luôn mềm, độ hoàn thiện tốt hơn rất nhiều.</p>

                        <h4>4. Giá cả</h4>
                        <p>Nếu giá rẻ hơn thị trường quá nhiều → gần như chắc chắn là hàng fake.</p>

                        <p>➡ Hãy chọn cửa hàng uy tín để tránh mất tiền oan.</p>
                    ",
                    'image' => 'shoes2.jpg'
                ],

                3 => [
                    'title' => '5 Mẹo Giữ Giày Trắng Luôn Như Mới – Dễ Làm Tại Nhà',
                    'content' => "
                        <p>Giày trắng đẹp nhưng rất dễ bị dơ. Đây là 5 mẹo cực đơn giản để giữ đôi sneaker trắng như mới.</p>

                        <h4>1. Sử dụng baking soda + kem đánh răng</h4>
                        <p>Hòa hỗn hợp rồi chà nhẹ → sạch ngay vết ố vàng.</p>

                        <h4>2. Dùng khăn ướt kháng khuẩn</h4>
                        <p>Tiện lợi để lau bụi hằng ngày.</p>

                        <h4>3. Xịt chống nước – chống bẩn</h4>
                        <p>Giúp hạn chế nước mưa và bụi bẩn bám vào giày.</p>

                        <h4>4. Không phơi dưới nắng gắt</h4>
                        <p>Dễ làm giày bị vàng, gãy form.</p>

                        <h4>5. Giặt dây giày riêng</h4>
                        <p>Dây giày sạch sẽ giúp giày nhìn mới hơn rất nhiều.</p>

                        <p>➡ Áp dụng 5 mẹo này đảm bảo đôi giày trắng của bạn luôn như mới!</p>
                    ",
                    'image' => 'shoes3.jpg'
                ],
            ];

            $postId = request()->route('id');
            $post = $posts[$postId] ?? [
                'title' => 'Not Found',
                'content' => '<p>Bài viết không tồn tại.</p>',
                'image' => 'shoes1.jpg'
            ];
        @endphp


        <div class="row">
            <div class="col-md-12">

                <h2 class="title-1 m-b-20">{{ $post['title'] }}</h2>

                <img src="{{ asset('public/images/'.$post['image']) }}"
                     alt="{{ $post['title'] }}"
                     class="img-fluid mb-4 rounded">

                {!! $post['content'] !!}

                <a href="{{ route('blog') }}" class="btn btn-info mt-4">
                    ← Back to Blog
                </a>
            </div>
        </div>
    </div>
</section>

@endsection
