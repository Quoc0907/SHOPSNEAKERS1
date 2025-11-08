<?php

// namespace App\Http\Controllers;

// use App\Models\Category;
// use App\Models\Product;
// use Illuminate\Http\Request;

// class ProductController extends Controller
// {
//     public function index(){
//         $category_data = Category::isDeleted()->get();
//         $product_data = Product::isDeleted()->get();
//         return view("product.index", [
//             "category_data" => $category_data,
//             "product_data" => $product_data
//         ]);
//     }

//     public function detail(){
//         $product = request()->product; // lay ma san pham tren url
//        $product_data = Product::find($product)->where("XOA", "=", 0); // truy van du lieu tu ma san pham
//         $product_data = Product::isDeleted()->where("MASP", "=", $product)->first();
//         return view("product.detail", ["product_data" => $product_data]);
//     }
// }

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Lấy danh mục chưa xóa
        $category_data = Category::isDeleted()->get();

        // Lấy tham số trên URL (nếu có)
        $category = request()->get('category');
        $search = request()->get('search');

        // Truy vấn sản phẩm
        $query = Product::isDeleted();

        if (!empty($category)) {
            $query->where('LOAI', $category);
        }

        if (!empty($search)) {
            $query->where('TENSP', 'like', "%{$search}%");
        }

        $product_data = $query->paginate(3);

        return view('product.index', [
            'category_data' => $category_data,
            'product_data' => $product_data
        ]);
    }

    // public function detail()
    // {
    //     $product = request()->product; // lấy mã sản phẩm trên URL
    //     $product_data = Product::isDeleted()
    //         ->where('MASP', $product)
    //         ->first();

    //     return view('product.detail', ['product_data' => $product_data]);
    // }
    public function detail(){
        $product = request()->product; // lay ma san pham tren url
//        $product_data = Product::find($product)->where("XOA", "=", 0); // truy van du lieu tu ma san pham
        $product_data = Product::isDeleted()->where("MASP", "=", $product)->first();
        return view("product.detail", ["product_data" => $product_data]);
    }
    public function show($id)
    {
        $product = Product::where('MASP', $id)->firstOrFail();
        return view('product.detail', compact('product'));
    }
}