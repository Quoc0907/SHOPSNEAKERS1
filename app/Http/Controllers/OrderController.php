<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        return view("order.index");
    }

    public function verify(){
        $token = request()->token;
        $order = Order::where("token", "=", $token)->first();
        $order->TRANGTHAI = "da-xac-nhan";
        $order->save();
        return redirect()->route("order.index");
    }
}
