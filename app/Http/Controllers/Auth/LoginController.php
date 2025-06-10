<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Kiểm tra người dùng
        $user = User::where('email', $request->email)->first();

        // Nếu tìm thấy người dùng và mật khẩu khớp
        if ($user && $user->password === $request->password) {
            Auth::login($user);
            return redirect()->intended('/db');
        }

        // Nếu không tìm thấy hoặc mật khẩu không khớp
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

   
    public function logout(Request $request)
    {
        Auth::logout(); // Đăng xuất người dùng

        $request->session()->invalidate(); // Hủy session
        $request->session()->regenerateToken(); // Tạo lại CSRF token

        return redirect('/login'); // Chuyển hướng về trang đăng nhập
    }
}