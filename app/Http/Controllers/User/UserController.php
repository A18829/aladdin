<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\NhaThau;
use App\Models\ThuongHieu;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{

    public function index()
    {
        // Lấy dữ liệu từ bảng nhahang
        $users = User::all();
        // Trả về view với dữ liệu
        return view('user.user', compact('users'));
    }

     public function edit($id)
    {
        $userr = User::findOrFail($id);
        return view('user.edit', compact('userr'));
    }

    // Cập nhật nhà hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        try {
            $user = User::findOrFail($id);
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');
            $user->level = $request->input('level');
            $user->status = $request->input('status');
            $user->save();

            return redirect()->route('dsuser')->with('success', 'Cập nhật nhà hàng thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
        }    
    }

    

     public function create()
    {
        $nhathaus = NhaThau::all();
        $thuonghieu = ThuongHieu::all();
        return view('nhahang.create', compact('nhathaus','thuonghieu')); // Tạo file view này
    }

    // Phương thức store đã được cập nhật ở bước trước
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
            'level' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        try {
            // Tự sinh ID
            $maxId = User::max('id');
            $newId = $maxId ? $maxId + 1 : 1;

            User::create([
                'id' => $newId,
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'level' => $request->level,
                'status' => $request->status,
            ]);

            return redirect()->route('dsuser')->with('success', 'Người dùng đã được thêm mới!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Không thể thêm người dùng: ' . $e->getMessage()]);
        }
    } 


    public function checkuser(Request $request)
    {
        $request->validate([
            'field' => 'required|string|max:255',
        ]);

        $exists = User::where('email', $request->field)->exists();

        return response()->json(['exists' => $exists]);
    }
    
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect()->route('dsuser')->with('success', 'Người dùng đã được xóa!');
        }
        return redirect()->route('dsuser')->with('error', 'Người dùng không tồn tại!');
    }
    
    public function export()
    {
        $nhahangs = nhahang::all(); // Lấy tất cả dữ liệu từ bảng Nhahang
        return Excel::download(new ExcelExport($nhahangs, 'nhahang'), 'nhahangs.xlsx');
    }

    

    
}