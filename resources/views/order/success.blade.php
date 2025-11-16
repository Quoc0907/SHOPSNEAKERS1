@extends('layout.default')

@section('main')
<div class="container py-5 text-center">
    <h1>ĐẶT HÀNG THÀNH CÔNG</h1>
    <p><b>Cảm ơn bạn đã đặt hàng!</b></p>

    @if(session('user') && session('order'))
        @php
            $user = session('user');
            $order = session('order');
        @endphp

        <p>
            Một email xác nhận đã được gửi tới <b>{{ $user->EMAIL }}</b>.<br>
            Vui lòng kiểm tra email của bạn và hoàn tất xác nhận đơn hàng.
        </p>

        <h4 class="mt-4">Thông tin đơn hàng #{{ $order->id }}</h4>
        <p><b>Tổng tiền:</b> {{ number_format($order->TRIGIA) }} đ</p>
        <p><b>Phương thức vận chuyển:</b> {{ $order->PTVC }}</p>

        <h4 class="mt-3">Chi tiết sản phẩm</h4>
        <table class="table table-bordered mx-auto" style="max-width:700px;">
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Số lượng</th>
                    <th>Giá</th>
                    <th>Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->details as $item)
                    <tr>
                        <td>{{ $item->product->TENSP ?? 'Sản phẩm đã xóa' }}</td>
                        <td>{{ $item->size ?? '-' }}</td>
                        <td>{{ $item->color ?? '-' }}</td>
                        <td>{{ $item->SL }}</td>
                        <td>{{ number_format($item->GIABAN) }} đ</td>
                        <td>{{ number_format($item->SL * $item->GIABAN) }} đ</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{ route('shop.index') }}" class="btn btn-primary mt-4">Quay lại cửa hàng</a>

    @else
        <p>Bạn chưa đăng nhập hoặc đơn hàng không tồn tại.</p>
        <a href="{{ route('shop.index') }}" class="btn btn-primary mt-2">Quay lại cửa hàng</a>
    @endif
</div>
@endsection
