<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    // Hiển thị danh sách danh mục
    public function index()
    {
        $categories = Category::where("XOA", 0)->get();
        return view("admin.category.index", compact('categories'));
    }

    // Thêm hoặc sửa danh mục
    // public function edit($category = null, Request $request)
    public function edit(Request $request, $category = null)
    
    {
        // ✅ Nếu là POST → xử lý lưu dữ liệu
        if ($request->isMethod('post')) {

            // --- 1. Xác thực dữ liệu ---
            if ($request->has('category')) { // Cập nhật
                $rules = [];
                if ($request->name != $request->categoryName) {
                    $rules['categoryName'] = 'required|unique:categories,TENLOAI|max:40';
                }
                if ($request->hasFile('categoryImage')) {
                    $rules['categoryImage'] = 'mimes:jpg,jpeg,png,gif';
                }
                $request->validate($rules);
            } else { // Thêm mới
                $request->validate([
                    'categoryName' => 'required|unique:categories,TENLOAI|max:40',
                    'categoryImage' => 'required|mimes:jpg,jpeg,png,gif',
                ]);
            }

            // --- 2. Xử lý upload hình ---
            if ($request->hasFile('categoryImage')) {
                $file = $request->file('categoryImage');
                $fileName = md5(now() . $file->getClientOriginalName()) . '.' . $file->extension();
                $file->move(public_path('uploads'), $fileName);
                $file_url = asset('public/uploads/' . $fileName);
            }

            // --- 3. Lưu dữ liệu ---
            if ($request->has('category')) { // Cập nhật
                if (!$request->hasFile('categoryImage')) {
                    $file_url = $request->image;
                }

                $update = Category::find($request->category)->update([
                    'TENLOAI' => $request->categoryName,
                    'HINHANH' => $file_url,
                    'MOTA' => $request->categoryDescription,
                ]);

                return redirect()->back()->with('success', $update ? 'Cập nhật thành công' : 'Cập nhật thất bại');
            } else { // Thêm mới
                $insert = DB::table('categories')->insert([
                    'MALOAI' => 'FST' . sprintf('%05d', Category::count() + 1),
                    'TENLOAI' => $request->categoryName,
                    'HINHANH' => $file_url,
                    'MOTA' => $request->categoryDescription,
                ]);

                return redirect()->back()->with('success', $insert ? 'Thêm mới thành công' : 'Thêm mới thất bại');
            }
        }

        // ✅ Nếu là GET → hiển thị form
        $category_data = null;
        if ($category) {
            $category_data = Category::find($category);
        }

        return view('admin.category.edit', compact('category_data'));
    }

    // Xóa danh mục (soft delete)
    public function delete($category)
    {
        $cat = Category::find($category);
        if ($cat) {
            $cat->XOA = 1;
            $cat->save();
            return redirect()->back()->with('success', 'Xóa thành công');
        }
        return redirect()->back()->with('error', 'Không tìm thấy mã danh mục');
    }
}
