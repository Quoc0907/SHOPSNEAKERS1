@extends('layout.admin')

@section('main')
<div class="content">
    <h4>Chi tiết đơn hàng #{{ $order->id }}</h4>

    <div class="mb-3">
        <strong>Người đặt:</strong> {{ $order->user->name ?? 'Khách vãng lai' }} <br>
        <strong>Ngày đặt:</strong> {{ $order->NGHD->format('d-m-Y') }} <br>
        <strong>Trị giá:</strong> {{ number_format($order->TRIGIA) }} VNĐ <br>
        <strong>Phương thức vận chuyển:</strong> {{ $order->PTVC ?? '-' }} <br>
        <strong>Trạng thái:</strong> {{ $order->TRANGTHAI }}
    </div>

    <!-- Form đổi trạng thái -->
    <form action="{{ route('admin.order.updateStatus', $order->id) }}" method="POST" class="mb-4">
        @csrf
        @method('PUT')
        <label for="TRANGTHAI">Cập nhật trạng thái:</label>
        <select name="TRANGTHAI" id="TRANGTHAI" class="form-control w-25 d-inline-block">
            <option value="pending" {{ $order->TRANGTHAI == 'pending' ? 'selected' : '' }}>Chưa giải quyết</option>
            <option value="completed" {{ $order->TRANGTHAI == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
            <option value="canceled" {{ $order->TRANGTHAI == 'canceled' ? 'selected' : '' }}>Đã hủy</option>
        </select>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>

    <h5>Danh sách sản phẩm</h5>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->details as $detail)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $detail->product->TENSP ?? 'Sản phẩm đã xóa' }}</td>
                <td>{{ $detail->SOLUONG }}</td>
                <td>{{ number_format($detail->GIABAN) }} VNĐ</td>
                <td>{{ number_format($detail->SOLUONG * $detail->GIABAN) }} VNĐ</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('admin.order.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
</div>
@stop
