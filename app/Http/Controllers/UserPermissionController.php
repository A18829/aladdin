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
        // Xóa tất cả quyền cũ
        UserPermission::where('user_id', $userId)->delete();

        // Thêm quyền mới
        if ($request->has('permissions')) {
            foreach ($request->permissions as $routeName) {
                $maxId = UserPermission::max('id');
                    $newId = $maxId ? $maxId + 1 : 1;
                UserPermission::create([
                    'id' => $newId,
                    'user_id' => $userId,
                    'route_name' => $routeName,
                ]);
            }
        }

        return redirect()->route('user.permissions.index')->with('success', 'Permissions updated successfully.');
    }
}