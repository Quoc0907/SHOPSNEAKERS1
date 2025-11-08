<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function index(){
//        if(auth()->guard("admin")->check() && auth()->guard("admin")->user()->isAdmin()){
//            dd("You are admin");
//        }
//        else{
//            dd("You are not admin");
//        }

        $products = Product::all()->where("XOA", "=", 0);
        return view("admin.product.index", ["products" => $products]);
    }

    public static function edit(){
        if(request()->isMethod("post")){
            if(isset(request()->product)) { // cap nhat
                $validate = true;

                if(request()->name != request()->productName){ // nguoi dung cap nhat ten moi
                    $validate = request()->validate( // them moi
                        [
                            "productName" => "required|unique:products,TENSP|max:40",
                        ]
                    );
                }

                if(isset(request()->productImage)){ // nguoi dung cap nhat hinh anh moi
                    $validate = request()->validate( // them moi
                        [
                            "productImage" => "required|mimes:jpg,jpeg,png,gif",
                        ]
                    );
                }
            }
            else{
                $validate = request()->validate( // them moi
                    [
                        "productName" => "required|unique:products,TENSP|max:40",
                        "productImage" => "required|mimes:jpg,jpeg,png,gif",
                    ]
                );
            }
            if($validate){ // neu xac thuc thanh cong
                // di chuyen file upload vao thu muc public/uploads
                if(isset(request()->productImage)){
                    $file_obj = request()->productImage;
                    $file_ext = $file_obj->extension();
                    $file_name = md5(
                            date("Y-m-d H:i:s")
                            .$file_obj->getClientOriginalName()
                        ).".".$file_ext;
                    $file_url = asset("public/uploads")."/".$file_name;
                    $file_obj->move(public_path("uploads"), $file_name);
                }

                if(isset(request()->product)){ // cap nhat
                    if(!isset(request()->productImage)){
                        $file_url = request()->image;
                    }

                    $query = Product::find(request()->product)->update([
                        "TENSP" => request()->productName,
                        "HINHANH" => $file_url, // duong dan toi file upload
                        "DVT" => request()->productUnit,
                        "NUOCSX" => request()->productMFNation,
                        "GIA" => request()->productPrice,
                        "MOTA" => request()->productDescription,
                        "LOAI" => request()->productCategory
                    ]);

                    if($query){
                        return redirect()->back()->with("success", "Cập nhật thành công");
                    }
                    else{
                        return redirect()->back()->with("success", "Cập nhật thất bại");
                    }
                }
                else{ // them moi
                    $query = DB::table("products")->insert([
                        "MASP" => "FSP".sprintf("%05d", Product::all()->count()+1), // FSP00001
                        "TENSP" => request()->productName,
                        "HINHANH" => $file_url, // duong dan toi file upload
                        "DVT" => request()->productUnit,
                        "NUOCSX" => request()->productMFNation,
                        "GIA" => request()->productPrice,
                        "MOTA" => request()->productDescription,
                        "LOAI" => request()->productCategory
                    ]);

                    if($query){
                        return redirect()->back()->with("success", "Thêm mới thành công");
                    }
                    else{
                        return redirect()->back()->with("success", "Thêm mới thất bại");
                    }
                }
            }
        }
        else{
    $category_data = Category::all()->where("XOA", "=", 0);

    if(isset(request()->product)){
        $product = request()->product;
        $product_data = Product::find($product);
        return view("admin.product.edit", [
            "product_data" => $product_data,
            "category_data" => $category_data
        ]);
    }
    
    // Trường hợp thêm mới
    return view("admin.product.edit", [
        "category_data" => $category_data
    ]);
}

    }

    public static function delete(){
        $product = request()->product;
        $pro = Product::find($product);
        if($pro){
            $pro->XOA = 1;
            $result = $pro->save();
            if($result){
                return redirect()->back()->with("success", "Xóa thành công");
            }
            else{
                return redirect()->back()->with("error", "Xóa thất bại");
            }
        }
        else{
            return redirect()->back()->with("error", "Không tìm thấy mã sản phẩm");
        }

    }

}
