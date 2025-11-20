<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
    // -----------------------------
    // Danh sách đơn hàng
    // -----------------------------
    public function index()
    {
        // Lấy tất cả đơn hàng kèm user
        $orders = Order::with('user')->orderBy('NGHD', 'desc')->get();

        // Nếu NGHD là string trong DB, convert sang Carbon
        $orders->each(function ($order) {
            if (!($order->NGHD instanceof \Carbon\Carbon)) {
                $order->NGHD = \Carbon\Carbon::parse($order->NGHD);
            }
        });

        return view('admin.order.index', compact('orders'));
    }

    // -----------------------------
    // Xem chi tiết đơn hàng
    // -----------------------------
    public function show($id)
    {
        $order = Order::with(['details.product', 'user'])->findOrFail($id);

        // Convert NGHD sang Carbon nếu cần
        if (!($order->NGHD instanceof \Carbon\Carbon)) {
            $order->NGHD = \Carbon\Carbon::parse($order->NGHD);
        }

        return view('admin.order.show', compact('order'));
    }

    // -----------------------------
    // Cập nhật trạng thái đơn hàng
    // -----------------------------
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'TRANGTHAI' => 'required|in:pending,completed,canceled'
        ]);

        $order = Order::findOrFail($id);
        $order->TRANGTHAI = $request->TRANGTHAI;
        $order->save();

        return redirect()->route('admin.order.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }

    // -----------------------------
    // Xóa đơn hàng
    // -----------------------------
    public function delete($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return redirect()->route('admin.order.index')->with('success', 'Xóa đơn hàng thành công!');
    }
}
    