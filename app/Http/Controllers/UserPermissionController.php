<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{
    public function index()
    {
        $users = User::all();
        $permissions = Permission::all();
        return view('user_permissions.index', compact('users', 'permissions'));
    }

    public function update(Request $request, $userId)
    {
        try {
        // Xóa tất cả quyền cũ
        UserPermission::where('user_id', $userId)->delete();

        // Thêm quyền mới
        if ($request->has('permissions')) {
            foreach ($request->permissions as $routeName) {
                $existingIds = UserPermission::pluck('id')->toArray();
                $newId = 1; // Bắt đầu từ 1
                while (in_array($newId, $existingIds)) {
                    $newId++; // Tăng ID nếu đã tồn tại
                }
                UserPermission::create([
                    'id' => $newId,
                    'user_id' => $userId,
                    'route_name' => $routeName,
                ]);
            }
        }

        return redirect()->route('user.permissions.index')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại ' . $e->getMessage()]);
        }
    }
}