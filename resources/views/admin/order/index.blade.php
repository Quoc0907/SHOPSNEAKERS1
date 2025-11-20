@extends('layout.admin')
@section('main')
<div class="content">
    <h4>Danh sách đơn hàng</h4>

    <!-- Nút quay về trang chủ admin -->
    <a href="{{ route('admin.home.index') }}" class="btn btn-secondary mb-3">Quay về trang chủ</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Người đặt</th>
                <th>Ngày đặt</th>
                <th>Trị giá</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $order->user->name ?? 'Khách vãng lai' }}</td>
                <td>{{ $order->NGHD->format('d-m-Y') }}</td>
                <td>{{ number_format($order->TRIGIA) }} VNĐ</td>
                <td>{{ $order->status_label ?? $order->TRANGTHAI }}</td>
                <td>
                    <a href="{{ route('admin.order.show', $order->id) }}" class="btn btn-info">Xem</a>
                    <a href="{{ route('admin.order.delete', $order->id) }}" class="btn btn-danger" onclick="return confirm('Xóa đơn hàng?')">Xóa</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
