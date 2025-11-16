<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 650px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
        }
        .header {
            background: #111;
            padding: 20px;
            text-align: center;
        }
        .header img {
            max-width: 150px;
        }
        .banner {
            width: 100%;
        }
        .content {
            padding: 25px;
        }
        h2 {
            color: #333;
            margin-top: 0;
        }
        p {
            color: #555;
            line-height: 1.6;
            font-size: 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 25px;
        }
        th {
            background: #fafafa;
            padding: 12px;
            border-bottom: 2px solid #ddd;
            font-size: 14px;
            text-align: left;
        }
        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            font-size: 14px;
            color: #444;
        }
        .total-row td {
            font-weight: bold;
            font-size: 16px;
            color: #000;
            border-top: 2px solid #111;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 14px 25px;
            background: #111;
            color: white !important;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
        }
        .footer {
            background: #111;
            color: #bbb;
            padding: 15px;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="email-container">

    <!-- Header Logo -->
    <div class="header">
        <img src="{{ asset('public/images/logo.png') }}" alt="Shop Sneakers">
    </div>

    <!-- Banner -->
    <img src="https://i.imgur.com/Z9bKZgO.png" class="banner">

    <div class="content">
        <h2>Xin chào {{ $user->name }},</h2>
        <p>
            Cảm ơn bạn đã đặt hàng tại <strong>Shop Sneakers</strong>!  
            Đây là thông tin chi tiết đơn hàng của bạn:
        </p>

        <!-- Order Info -->
        <p><strong>Mã đơn hàng:</strong> {{ $order->id }}</p>
        <p><strong>Ngày tạo:</strong> {{ $order->NGHD }}</p>
        <p><strong>Phương thức vận chuyển:</strong> {{ $order->PTVC }}</p>

        <!-- Cart Table -->
        <table>
            <thead>
                <tr>
                    <th>Sản phẩm</th>
                    <th>Size</th>
                    <th>Màu</th>
                    <th>SL</th>
                    <th>Giá</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart as $item)
                <tr>
                    <td>{{ $item['TENSP'] }}</td>
                    <td>{{ $item['size'] }}</td>
                    <td>{{ $item['color'] }}</td>
                    <td>{{ $item['QTY'] }}</td>
                    <td>{{ number_format($item['GIA'], 0, ',', '.') }}₫</td>
                </tr>
                @endforeach

                <tr class="total-row">
                    <td colspan="4">Tổng thanh toán</td>
                    <td>{{ number_format($order->TRIGIA, 0, ',', '.') }}₫</td>
                </tr>
            </tbody>
        </table>

        <!-- Button -->
        <center>
            <a href="http://localhost/your-order-page" class="btn">Xem chi tiết đơn hàng</a>
        </center>

    </div>

    <!-- Footer -->
    <div class="footer">
        © 2025 Shop Sneakers — Cảm ơn bạn đã tin tưởng!
    </div>

</div>

</body>
</html>
