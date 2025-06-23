<?php
namespace App\Http\Controllers\mang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mang;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;


class mangcontroller extends Controller
{

    public function index()
    {
        // Lấy dữ liệu từ bảng nhahang
        $mangs = mang::all();

        // Trả về view với dữ liệu
        return view('mang.dsmang', compact('mangs'));
    }

     public function edit($id)
    {
        $mang = mang::findOrFail($id);
        return view('mang.edit', compact('mang'));
    }

    // Cập nhật nhà hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'nhamang' => 'required|string|max:255',
            'men' => 'required|string|max:255',
            'account' => 'required|string|max:255',
            'pass' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
            
        ]);
        try {
            $mang = mang::findOrFail($id);
            $mang->nhahang = $request->input('nhahang');
            $mang->nhamang = $request->input('nhamang');
            $mang->men = $request->input('men');
            $mang->account = $request->input('account');
            $mang->pass = $request->input('pass');
            $mang->diachi = $request->input('diachi');
            $mang->save();

            return redirect()->route('dsmang')->with('success', 'Cập nhật thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
        }       
    }

    

     public function create()
    {
        return view('mang.create'); // Tạo file view này
    }

    // Phương thức store đã được cập nhật ở bước trước
    public function store(Request $request)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'nhamang' => 'required|string|max:255',
            'men' => 'required|string|max:255',
            'account' => 'required|string|max:255',
            'pass' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
        ]);
    
        try {
            // Tự sinh ID
            $maxId = mang::max('id');
            $newId = $maxId ? $maxId + 1 : 1;

            mang::create([
                'id' => $newId,
                'nhahang' => $request->nhahang,
                'nhamang' => $request->nhamang,
                'men' => $request->men,
                'account' => $request->account,
                'pass' => $request->pass,
                'diachi' => $request->diachi,
            ]);

            return redirect()->route('dsmang')->with('success', 'Đường truyền đã được thêm mới!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Không thể thêm đường truyền: ' . $e->getMessage()]);
        }
    }

    public function destroy($id)
    {
        $mang = mang::find($id);
        if ($mang) {
            $mang->delete();
            return redirect()->route('dsmang')->with('success', 'Đường truyền đã được xóa!');
        }
        return redirect()->route('dsmang')->with('error', 'Đường truyền không tồn tại!');
    }

    public function export()
    {
        $mangs = mang::all(); // Lấy tất cả dữ liệu từ bảng Mang
        return Excel::download(new ExcelExport($mangs, 'mang'), 'mangs.xlsx');
    }

     public function checkmang(Request $request)
    {
        $request->validate([
            'field' => 'required|string|max:255',
        ]);

        $exists = mang::where('account', $request->field)->exists();

        return response()->json(['exists' => $exists]);
    }
}