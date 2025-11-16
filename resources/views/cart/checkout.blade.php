@extends('layout.default')
@section('main')

<div class="container" style="max-width:900px; margin:50px auto; padding:20px; border:1px solid #ddd; border-radius:10px; background:#fff;">
    <h2 style="text-align:center; margin-bottom:30px;">Thanh toán</h2>

    @if(session('cart') && count(session('cart')) > 0)
        <form action="{{ route('checkout.updateCart') }}" method="POST">
            @csrf
            <table style="width:100%; border-collapse:collapse; margin-bottom:30px;">
                <tr style="background:#f5f5f5;">
                    <th style="padding:10px; border:1px solid #ddd;">Sản phẩm</th>
                    <th style="padding:10px; border:1px solid #ddd;">Số lượng</th>
                    <th style="padding:10px; border:1px solid #ddd;">Giá</th>
                    <th style="padding:10px; border:1px solid #ddd;">Tổng</th>
                    <th style="padding:10px; border:1px solid #ddd;">Hành động</th>
                </tr>
                @php $total = 0; @endphp
                @foreach(session('cart') as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
                    <tr>
                        <td style="padding:10px; border:1px solid #ddd;">{{ $item['name'] }}</td>
                        <td style="padding:10px; border:1px solid #ddd;">
                            <input type="number" name="quantities[{{ $id }}]" value="{{ $item['quantity'] }}" min="1" style="width:60px; padding:5px;">
                        </td>
                        <td style="padding:10px; border:1px solid #ddd;">{{ number_format($item['price']) }}₫</td>
                        <td style="padding:10px; border:1px solid #ddd;">{{ number_format($subtotal) }}₫</td>
                        <td style="padding:10px; border:1px solid #ddd;">
                            <a href="{{ route('checkout.remove', $id) }}" style="color:red;">Xóa</a>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="3" style="text-align:right; padding:10px; font-weight:bold;">Tổng cộng:</td>
                    <td style="padding:10px; font-weight:bold;">{{ number_format($total) }}₫</td>
                    <td></td>
                </tr>
            </table>
            <button type="submit" style="padding:10px 20px; background:#ffc107; color:#000; border:none; border-radius:5px; cursor:pointer; margin-bottom:30px;">
                Cập nhật giỏ hàng
            </button>
        </form>

        <form action="{{ route('checkout.process') }}" method="POST" style="display:flex; flex-direction:column; gap:15px;">
            @csrf
            <h3>Thông tin khách hàng</h3>
            <input type="text" name="name" placeholder="Họ tên" required style="padding:10px; border:1px solid #ddd; border-radius:5px;">
            <input type="email" name="email" placeholder="Email" required style="padding:10px; border:1px solid #ddd; border-radius:5px;">
            <input type="text" name="phone" placeholder="Số điện thoại" required style="padding:10px; border:1px solid #ddd; border-radius:5px;">
            <input type="text" name="address" placeholder="Địa chỉ nhận hàng" required style="padding:10px; border:1px solid #ddd; border-radius:5px;">

            <button type="submit" style="padding:12px; background:#28a745; color:#fff; border:none; border-radius:5px; font-size:16px; cursor:pointer;">
                Xác nhận thanh toán
            </button>
        </form>
    @else
        <p>Giỏ hàng trống.</p>
    @endif
</div>

@endsection
