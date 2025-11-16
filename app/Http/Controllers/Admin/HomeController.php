<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Http\Middleware\EmployeeMiddleWare;

// class HomeController extends Controller
// {
//     public function username(){
//         return "EMAIL";
//     }

//     public function index(){
//         return view("admin.home.index");
//     }

//     public static function login(){
//         if(request()->isMethod("post")){
//             $data = [
//                 "email" => request()->email,
//                 "password" => request()->password,
//             ];
//             $check = auth()->guard("admin")->attempt($data);
//             if($check)
//                 return redirect()->route("admin.home.index")->with("success", "Đăng nhập thành công");
//             else
//                 return redirect()->back()->with("error", "Đăng nhập thất bại");
//         }
//         else{
//             if(auth()->guard("admin")->check())
//                 return redirect()->route("admin.home.index");
//             return view("admin.login");
//         }
//     }
    
// }
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        return view("admin.home.index");
    }

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $credentials = $request->only('email', 'password');

            if (Auth::guard('admin')->attempt($credentials)) {
                $request->session()->regenerate();
                return redirect()->route('admin.home.index')->with('success', 'Đăng nhập thành công');
            }

            return back()->with('error', 'Email hoặc mật khẩu không đúng');
        }

        if (Auth::guard('admin')->check()) {
            return redirect()->route('admin.home.index');
        }

        return view('admin.login');
    }
}
