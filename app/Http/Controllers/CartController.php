<?php

namespace App\Http\Controllers;

use App\Mail\OrderMailable;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Trang giỏ hàng
    public function index()
    {
        $cart = session()->get('cart', []);
        $user = Auth::user(); // dùng guard mặc định
        return view('cart.index', compact('cart', 'user'));
    }

    // Add sản phẩm vào giỏ
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
        if (!$product) {
            return response()->json(['message' => 'Sản phẩm không tồn tại'], 404);
        }

        $size = $request->size;
        $color = $request->color;

        if (!$size || $size === "Choose an option" || !$color || $color === "Choose an option") {
            return response()->json(['message' => 'Vui lòng chọn SIZE và COLOR'], 400);
        }

        $cart = session()->get('cart', []);
        $key = $product->MASP . '-' . $size . '-' . $color;

        if (!isset($cart[$key])) {
            $cart[$key] = [
                'MASP' => $product->MASP,
                'TENSP' => $product->TENSP,
                'GIA' => $product->GIA,
                'HINHANH' => $product->HINHANH,
                'QTY' => 0,
                'size' => $size,
                'color' => $color,
            ];
        }

        $cart[$key]['QTY'] += $request->quantity ?? 1;
        session()->put('cart', $cart);

        return response()->json([
            'success' => true,
            'message' => 'Đã thêm vào giỏ hàng!',
            'cart_count' => count($cart)
        ]);
    }

    // Thêm sản phẩm và chuyển sang thanh toán
    public function addToCheckout(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')
                             ->with('error', 'Bạn cần đăng nhập để mua hàng');
        }

        $this->add($request); 
        return redirect()->route('payment.index');
    }

    // Trang thanh toán
    public function pay(Request $request)
    {
        $user = Auth::user();
        $cart = session()->get('cart', []);

        if (!$user) {
            return redirect()->route('login')
                             ->with('error', 'Bạn cần đăng nhập để thanh toán');
        }

        if ($request->isMethod('post')) {
            if (empty($cart)) {
                return redirect()->back()->with('error', 'Giỏ hàng trống');
            }

            $total = 0;
            foreach ($cart as $item) {
                $total += $item['QTY'] * $item['GIA'];
            }

           $order = Order::create([
    'user_id' => $user->id,
    'MANV' => 'FSE00001',
    'TRIGIA' => $total,
    'PTVC' => $request->transport_method ?? 'Giao hàng tiêu chuẩn',
    'NGHD' => now(),
]);



foreach ($cart as $item) {
    OrderDetail::create([
        'order_id' => $order->id,  // <-- dùng id của order
        'MASP' => $item['MASP'],
        'SL' => $item['QTY'],
        'GIAGOC' => $item['GIA'],
        'GIABAN' => $item['GIA'],
    ]);
}


            // Mail::to($user->EMAIL)->send(new OrderMailable($order));
            // Gửi email sau khi tạo đơn
Mail::to($user->email)->send(new OrderMailable($order, $user));


            session()->forget('cart');

            return redirect()->route('order.success')
                             ->with(['user' => $user, 'order' => $order]);
        }

        return view('payment.index', compact('cart', 'user'));
    }

    // Cập nhật giỏ hàng
    public function update(Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($request->cart as $id => $data) {
            if (isset($cart[$id])) {
                $cart[$id]['QTY'] = $data['qty'];
            }
        }

        session()->put('cart', $cart);

        return back()->with('success', 'Cập nhật giỏ hàng thành công!');
    }

    // Xóa sản phẩm khỏi giỏ
    public function delete($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
    }
   

 public function addAndCheckout($MASP, Request $request)
{
    $user = Auth::user();
    if (!$user) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua hàng');
    }

    $product = Product::find($MASP);
    if (!$product) {
        return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
    }

    $cart = session()->get('cart', []);

    // Lấy size & color từ query, mặc định nếu không có
    $size = $request->query('size', '36');
    $color = $request->query('color', 'Default');

    $key = $product->MASP . '-' . $size . '-' . $color;

    if (!isset($cart[$key])) {
        $cart[$key] = [
            'MASP' => $product->MASP,
            'TENSP' => $product->TENSP,
            'GIA' => $product->GIA,
            'HINHANH' => $product->HINHANH,
            'QTY' => 0,
            'size' => $size,
            'color' => $color,
        ];
    }

    $cart[$key]['QTY'] += 1;
    session()->put('cart', $cart);

    // Chuyển thẳng sang trang thanh toán
    return redirect()->route('payment.index');
}

}
