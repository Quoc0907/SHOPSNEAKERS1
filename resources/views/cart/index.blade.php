@extends('layout.default')

@section('main')

<style>
.cart-page {
    width: 1200px;
    margin: 40px auto;
    font-family: 'Segoe UI', sans-serif;
}

.cart-title {
    text-align: center;
    font-size: 32px;
    margin-bottom: 30px;
    font-weight: bold;
}

table.cart-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

.cart-table th {
    text-transform: uppercase;
    padding: 15px;
    background: #f4f4f4;
    font-size: 14px;
    font-weight: bold;
    border-bottom: 1px solid #ddd;
}

.cart-table td {
    padding: 20px;
    border-bottom: 1px solid #eee;
    vertical-align: middle;
}

.cart-img {
    width: 90px;
    height: 110px;
    object-fit: cover;
    border-radius: 6px;
}

.qty-box {
    display: flex;
    gap: 8px;
    align-items: center;
}

.qty-btn {
    padding: 5px 12px;
    background: #eee;
    border-radius: 4px;
    cursor: pointer;
    font-size: 18px;
}

.qty-input {
    width: 45px;
    text-align: center;
    border: 1px solid #ddd;
    padding: 5px;
}

.cart-actions {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn-black {
    padding: 10px 25px;
    background: #000;
    color: white;
    border-radius: 25px;
    font-weight: bold;
    border: none;
    transition: .2s;
}

.btn-black:hover {
    background: #333;
}

.cart-totals {
    width: 360px;
    padding: 25px;
    border: 1px solid #ddd;
    border-radius: 10px;
    float: right;
}

.cart-totals h3 {
    margin-bottom: 15px;
    font-size: 20px;
    font-weight: bold;
}

.total-row {
    display: flex;
    justify-content: space-between;
    padding-bottom: 8px;
    margin-bottom: 10px;
    border-bottom: 1px solid #eee;
}

.btn-checkout {
    width: 100%;
    padding: 12px;
    background: #000;
    color: white;
    border-radius: 25px;
    font-size: 16px;
    font-weight: bold;
    border: none;
}

.btn-delete {
    background: red;
    color: white;
    padding: 6px 15px;
    border-radius: 6px;
    text-decoration: none;
    font-size: 14px;
}
</style>

<div class="cart-page">

    <h2 class="cart-title">YOUR CART</h2>

    @php $total = 0; @endphp

    @if(session('cart') && count(session('cart')) > 0)
    <form action="{{ route('cart.update') }}" method="POST">
        @csrf
        <table class="cart-table">
            <tr>
                <th>PRODUCT</th>
                <th>SIZE</th>
                <th>COLOR</th>
                <th>PRICE</th>
                <th>QUANTITY</th>
                <th>TOTAL</th>
                <th></th>
            </tr>

            @foreach ($cart as $id => $item)
                @php $subtotal = $item['GIA'] * $item['QTY']; $total += $subtotal; @endphp
                <tr>
                    <td>
                        <img src="{{ $item['HINHANH'] }}" class="cart-img" alt="{{ $item['TENSP'] }}">
                        <br>{{ $item['TENSP'] }}
                    </td>
                    <td>{{ $item['size'] }}</td>
                    <td>{{ $item['color'] }}</td>
                    <td>{{ number_format($item['GIA']) }}đ</td>
                    <td>
                        <div class="qty-box">
                            <button type="button" class="qty-btn" onclick="changeQty('{{ $id }}', -1)">-</button>
                            <input type="text" name="cart[{{ $id }}][qty]" value="{{ $item['QTY'] }}" class="qty-input" id="qty-{{ $id }}">
                            <button type="button" class="qty-btn" onclick="changeQty('{{ $id }}', 1)">+</button>
                        </div>
                    </td>
                    <td>{{ number_format($subtotal) }}đ</td>
                    <td>
                        <a href="{{ route('cart.delete', $id) }}" class="btn-delete">Xóa</a>
                    </td>
                </tr>
            @endforeach

        </table>

        <div class="cart-actions">
            <button type="submit" class="btn-black">UPDATE CART</button>
        </div>
    </form>

    <div class="cart-totals">
        <h3>CART TOTALS</h3>
        <div class="total-row">
            <span>Subtotal:</span>
            <span>{{ number_format($total) }}đ</span>
        </div>
        <div class="total-row">
            <span>Shipping:</span>
            <span>Free</span>
        </div>
        <div class="total-row">
            <strong>Total:</strong>
            <strong>{{ number_format($total) }}đ</strong>
        </div>

        <a href="{{ route('payment.index') }}">
            <button class="btn-checkout">PROCEED TO CHECKOUT</button>
        </a>
    </div>

    @else
        <p>Giỏ hàng trống.</p>
    @endif

</div>

<script>
function changeQty(id, change) {
    let input = document.getElementById("qty-" + id);
    let value = parseInt(input.value) + change;
    if (value < 1) value = 1;
    input.value = value;
}
</script>

@endsection
