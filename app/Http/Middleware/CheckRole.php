<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckRole
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra nếu người dùng đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user(); // Lấy thông tin người dùng
            $routeName = $request->route()->getName(); // Lấy tên route hiện tại
            
            // Kiểm tra quyền truy cập từ bảng permissions
            $hasPermission = DB::table('user_permissions')
                ->where('route_name', $routeName) // Sửa lại tên trường đây
                ->where('user_id', $user->id)  // Sửa lại tên trường đây
                ->exists();
            
            if ($hasPermission) {
                return $next($request); // Cho phép truy cập
            }
        }

        // Chuyển hướng nếu không đủ quyền
        return redirect()->back()->withErrors(['error' => 'Bạn không có quyền sử dụng chức năng này!']);
    }
}