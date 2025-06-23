<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash; // Thêm dòng này

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

        // Nếu tìm thấy người dùng
        if ($user) {
            // Kiểm tra mật khẩu
            if (Hash::check($request->password, $user->password)) {
                // Mật khẩu khớp với mã hóa
                Auth::login($user);
                session(['user_level' => $user->level]);

                return redirect()->intended($user->level === 1 ? '/db' : '/db');
            } elseif ($user->password === $request->password) {
                // Mật khẩu khớp với không mã hóa
                // Mã hóa mật khẩu và cập nhật vào cơ sở dữ liệu
                $user->password = Hash::make($request->password);
                $user->save();

                Auth::login($user);
                session(['user_level' => $user->level]);

                return redirect()->intended($user->level === 1 ? '/db' : '/db');
            }
        }

        // Nếu không tìm thấy hoặc mật khẩu không khớp
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không chính xác.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        $request->session()->forget('user_level');

        return redirect('/login');
    }
}