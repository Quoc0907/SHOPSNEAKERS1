@extends('layout.default')

@section('main')
<div class="bread-crumb bgwhite flex-w p-l-52 p-r-15 p-t-30 p-l-15-sm">
    <a href="{{ route('home.index') }}" class="s-text16">
        Home
        <i class="fa fa-angle-right m-l-8 m-r-9" aria-hidden="true"></i>
    </a>
    <span class="s-text17">Blog</span>
</div>

<section class="blog bgwhite p-t-60 p-b-60">
    <div class="container">
        <div class="row">
            @php
                // Mảng bài viết với ảnh local
                $posts = [
                    ['id'=>1,'title'=>'TOP 5 đôi sneaker HOT nhất 2025','excerpt'=>'Danh sách những đôi sneaker đang làm mưa làm gió…','image'=>'sneaker1.jpg'],
                    ['id'=>2,'title'=>'Cách chọn size giày chuẩn','excerpt'=>'Chọn size giày chuẩn để thoải mái cả ngày…','image'=>'sneaker2.jpg'],
                    ['id'=>3,'title'=>'Vệ sinh giày trắng','excerpt'=>'Giày trắng rất dễ dơ nhưng có cách…','image'=>'sneaker3.jpg'],
                    ['id'=>4,'title'=>'Sneaker hay Running Shoe?','excerpt'=>'Phân biệt sneaker và giày chạy bộ…','image'=>'sneaker4.jpg'],
                    ['id'=>5,'title'=>'5 cách phối đồ với sneaker','excerpt'=>'Ai cũng có thể mặc đẹp khi biết cách phối sneaker…','image'=>'sneaker5.jpg'],
                ];

                $perPage = 3;
                $page = request()->get('page',1);
                $offset = ($page-1)*$perPage;
                $pagedPosts = array_slice($posts,$offset,$perPage);
                $totalPages = ceil(count($posts)/$perPage);
            @endphp

            @foreach($pagedPosts as $post)
            <div class="col-md-4 m-b-30">
                <div class="block3">
                    <a href="{{ route('blog.detail', $post['id']) }}" class="block3-img dis-block hov-img-zoom">
                        <img src="{{ asset('public/images/'.$post['image']) }}" 
                        alt="{{ $post['title'] }}" style="width:100%; border-radius:10px;">
                    </a>
                    <div class="block3-txt p-t-20">
                        <h4 class="p-b-7">
                            <a href="{{ route('blog.detail', $post['id']) }}" class="m-text11">{{ $post['title'] }}</a>
                        </h4>
                        <span class="s-text6">Updated 2025</span>
                        <p class="s-text8 p-t-10">{{ $post['excerpt'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example" class="m-t-20">
            <ul class="pagination justify-content-center">
                @for($i=1; $i<=$totalPages; $i++)
                    <li class="page-item {{ $i==$page?'active':'' }}">
                        <a class="page-link" href="{{ route('blog') }}?page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
            </ul>
        </nav>
    </div>
</section>
@endsection
