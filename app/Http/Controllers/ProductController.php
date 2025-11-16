<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Trang shop chính
     */
    public function index(Request $request)
    {
        // Lấy danh mục chưa xóa
        $category_data = Category::isDeleted()->get();

        // Lấy tham số URL
        $category = $request->get('category');
        $search = $request->get('search');

        // Truy vấn sản phẩm chưa xóa
        $query = Product::isDeleted();

        if (!empty($category)) {
            $query->where('LOAI', $category);
        }

        if (!empty($search)) {
            $query->where('TENSP', 'like', "%{$search}%");
        }

        // Phân trang
        $product_data = $query->paginate(12);

        return view('product.index', [
            'category_data' => $category_data,
            'product_data' => $product_data
        ]);
    }

    /**
     * Trang chi tiết sản phẩm
     */
    public function detail($product)
{
    $product_data = Product::isDeleted()
        ->where('MASP', $product)
        ->firstOrFail();

    $related_products = Product::isDeleted()
        ->where('MASP', '!=', $product_data->MASP)
        ->where('LOAI', $product_data->LOAI)
        ->inRandomOrder()
        ->limit(6)
        ->get();

    return view('product.detail', compact('product_data', 'related_products'));
}

    /**
     * Trang kết quả search
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $products = Product::isDeleted()
            ->where('TENSP', 'LIKE', "%{$query}%")
            ->get();

        return view('product.search', [
            'products' => $products,
            'query' => $query
        ]);
    }

    /**
     * AJAX suggest search
     */
    public function searchAjax(Request $request)
    {
        $q = $request->get('q');

        $products = Product::where('TENSP', 'LIKE', "%{$q}%")
                            ->where('XOA', 0)
                            ->limit(5)
                            ->get();

        $html = '';
        if($products->count() > 0){
            foreach($products as $p){
                $html .= '
                <a href="'.route('product.detail', ['product' => $p->MASP]).'" class="search-suggest-item">
                    <img src="'.asset($p->HINHANH).'" alt="'.$p->TENSP.'">
                    <span>'.$p->TENSP.'</span>
                    <span class="price">'.number_format($p->GIA).'đ</span>
                </a>';
            }
        } else {
            $html = '<div class="search-suggest-item">Không tìm thấy sản phẩm</div>';
        }

        return $html;
    }
    // Product.php
public function sizes() {
    return $this->hasMany(ProductSize::class, 'product_id', 'MASP');
}

public function colors() {
    return $this->hasMany(ProductColor::class, 'product_id', 'MASP');
}
public function addToCheckout(Request $request)
{
    $request->merge(['quantity' => 1]); // mặc định 1 sản phẩm
    $this->add($request); // gọi method add để thêm vào giỏ hàng
    return redirect()->route('cart.pay'); // chuyển thẳng sang trang thanh toán
}

    
}
