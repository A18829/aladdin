<?php
namespace App\Http\Controllers\camera;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\camera;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;


class cameraController extends Controller
{

    public function index()
    {
        // Lấy dữ liệu từ bảng camera
        $cameras = camera::all();

        // Trả về view với dữ liệu
        return view('camera.dscamera', compact('cameras'));
    }

     public function edit($id)
    {
        $camera = camera::findOrFail($id);
        return view('camera.edit', compact('camera'));
    }

    // Cập nhật nhà hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'port' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'pass' => 'required|string|max:255',
            'passcam' => 'required|string|max:255',
        ]);
        try {
            $camera = camera::findOrFail($id);
            $camera->nhahang = $request->input('nhahang');
            $camera->domain = $request->input('domain');
            $camera->port = $request->input('port');
            $camera->user = $request->input('user');
            $camera->pass = $request->input('pass');
            $camera->passcam = $request->input('passcam');
            $camera->save();

            return redirect()->route('dscamera')->with('success', 'Cập nhật tài khoản thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
        }   
    } 

     public function create()
    {
        return view('camera.create'); // Tạo file view này
    }

    // Phương thức store đã được cập nhật ở bước trước
    public function store(Request $request)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'domain' => 'required|string|max:255',
            'port' => 'required|string|max:255',
            'user' => 'required|string|max:255',
            'pass' => 'required|string|max:255',
            'passcam' => 'required|string|max:255',
        ]);    

        try {
        // Tự sinh ID
            $maxId = camera::max('id');
            $newId = $maxId ? $maxId + 1 : 1;

            camera::create([
                'id' => $newId,
                'nhahang' => $request->nhahang,
                'domain' => $request->domain,
                'port' => $request->port,
                'user' => $request->user,
                'pass' => $request->pass,
                'passcam' => $request->passcam,
            ]);

            return redirect()->route('dscamera')->with('success', 'Tài khoản đã được thêm mới!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Không thể thêm tài khoản: ' . $e->getMessage()]);
        }    
    }

    public function destroy($id)
    {
        $camera = camera::find($id);
        if ($camera) {
            $camera->delete();
            return redirect()->route('dscamera')->with('success', 'Tài khoản đã được xóa!');
        }
        return redirect()->route('dscamera')->with('error', 'Tài khoản không tồn tại!');
    }

    public function export()
    {
        $cameras = camera::all(); // Lấy tất cả dữ liệu từ bảng camera
        return Excel::download(new ExcelExport($cameras, 'camera'), 'camera.xlsx');
    }

    
}