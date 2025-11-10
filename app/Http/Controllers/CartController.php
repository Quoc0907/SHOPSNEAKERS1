<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        return view("cart.index");
    }

    public function add(){
        $product = request()->product;
        $product_data = Product::find($product)->toArray();

        // khoi tao gio hang
        $cart = session("cart"); // lay cac san pham trong gio hang
        if(isset($cart[$product])){ // neu da ton tai trong gio hang
            $product_data["QTY"] = $cart[$product]["QTY"] + 1;
        }
        else{ // neu chua ton tai trong gio hang
            $product_data["QTY"] = 1;
        }

        $cart[$product] = $product_data;
        session(["cart" => $cart]);
        return redirect()->route("cart.index");
    }
}
// class CartController extends Controller
// {
//     // Hiển thị giỏ hàng
//     public function index() {
//         // return view("cart.index");
//         $cart = session("cart", []);
//     $total = 0;

//     foreach ($cart as $product) {
//         $total += $product["QTY"] * $product["GIA"];
//     }

//     return view("cart.index", compact("cart", "total"));

//     }

//     // Thêm sản phẩm vào giỏ
//     public function add() {
//         $productId = request()->product;

//         // Tìm sản phẩm
//         $product = Product::where("MASP", $productId)->where("XOA", 0)->first();
//         if (!$product) {
//             return redirect()->back()->with("error", "Sản phẩm không tồn tại hoặc đã bị xóa!");
//         }

//         // Lấy giỏ hàng hiện tại trong session
//         $cart = session()->get("cart", []);

//         // Nếu đã tồn tại trong giỏ -> tăng số lượng
//         if (isset($cart[$productId])) {
//             $cart[$productId]["QTY"] += 1;
//         } else {
//             // Nếu chưa tồn tại -> thêm mới
//             $cart[$productId] = [
//                 "MASP" => $product->MASP,
//                 "TENSP" => $product->TENSP,
//                 "HINHANH" => $product->HINHANH,
//                 "GIA" => $product->GIA,
//                 "QTY" => 1
//             ];
//         }

//         // Lưu lại giỏ hàng vào session
//         session(["cart" => $cart]);

//         return redirect()->route("cart.index")->with("success", "Đã thêm sản phẩm vào giỏ hàng!");
//     }

//     // Cập nhật giỏ hàng (nếu cần)
//     public function update(Request $request) {
//         $cart = session()->get("cart", []);

//         foreach ($request->quantities as $id => $qty) {
//             if (isset($cart[$id])) {
//                 $cart[$id]["QTY"] = max(1, (int)$qty);
//             }
//         }

//         session(["cart" => $cart]);
//         return redirect()->route("cart.index")->with("success", "Giỏ hàng đã được cập nhật!");
//     }

//     // Xóa 1 sản phẩm khỏi giỏ
//     public function remove($productId) {
//         $cart = session()->get("cart", []);
//         if (isset($cart[$productId])) {
//             unset($cart[$productId]);
//             session(["cart" => $cart]);
//         }

//         return redirect()->route("cart.index")->with("success", "Đã xóa sản phẩm khỏi giỏ hàng!");
//     }
// }
