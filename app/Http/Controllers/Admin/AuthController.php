<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // ✅ Thêm dòng này để dùng Hash

class AuthController extends Controller
{
    // ✅ Hiển thị form đăng nhập admin
    public function showLoginForm()
    {
        return view('admin.login');
    }

    // ✅ Xử lý đăng nhập admin
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard')->with('success', 'Đăng nhập thành công!');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ]);
    }

    // ✅ Đăng xuất admin
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login')->with('success', 'Đã đăng xuất thành công!');
    }

    // ✅ Hiển thị form đổi mật khẩu
    public function showChangePasswordForm()
    {
        return view('admin.change-password');
    }

    // ✅ Xử lý đổi mật khẩu
public function changePassword(Request $request)
{
    $request->validate([
        'current_password' => 'required',
        'new_password' => 'required|min:6|confirmed',
    ]);

    $admin = Auth::guard('admin')->user();

    if (!Hash::check($request->current_password, $admin->password)) {
        return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
    }

    $admin->password = Hash::make($request->new_password);
    $admin->save();

    // ✅ Chuyển hướng về trang admin sau khi đổi thành công
    // return redirect()->route('admin.dashboard')->with('success', 'Đổi mật khẩu thành công!');
    // return redirect()->route('admin.home.index')->with('success', 'Đổi mật khẩu thành công!');
    return redirect()->route('admin.home.index')->with('success', 'Đổi mật khẩu thành công!');


    
}

}
