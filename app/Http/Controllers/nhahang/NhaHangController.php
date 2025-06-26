<?php
namespace App\Http\Controllers\nhahang;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NhaHang;
use App\Models\NhaThau;
use App\Models\ThuongHieu;
use App\Exports\ExcelExport;
use Maatwebsite\Excel\Facades\Excel;


class NhaHangController extends Controller
{

    public function index()
    {
        // Lấy dữ liệu từ bảng nhahang
        $nhahangs = NhaHang::all();
        $nhathaus = NhaThau::all();
        $thuonghieu = ThuongHieu::all();
        // Trả về view với dữ liệu
        return view('nhahang.danhsachnhahang', compact('nhahangs','nhathaus','thuonghieu'));
    }

     public function edit($id)
    {
        $nhathaus = NhaThau::all();
        $thuonghieu = ThuongHieu::all();
        $nhahang = NhaHang::findOrFail($id);
        return view('nhahang.edit', compact('nhahang','nhathaus','thuonghieu'));
    }

    // Cập nhật nhà hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'vung' => 'required|string|max:255',
            'nhathau' => 'required|string|max:255',
            'ruijie' => 'required|string|max:255',
            'daucam' => 'required|string|max:255',
            'matcam' => 'required|string|max:255',
            'ten' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'iptinh' => 'required|string|max:255',
            'ipmc' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);
        try {
            $nhahang = NhaHang::findOrFail($id);
            $nhahang->vung = $request->input('vung');
            $nhahang->nhathau = $request->input('nhathau');
            $nhahang->ruijie = $request->input('ruijie');
            $nhahang->daucam = $request->input('daucam');
            $nhahang->matcam = $request->input('matcam');
            $nhahang->ten = $request->input('ten');
            $nhahang->diachi = $request->input('diachi');
            $nhahang->sdt = $request->input('sdt');
            $nhahang->iptinh = $request->input('iptinh');
            $nhahang->ipmc = $request->input('ipmc');
            $nhahang->status = $request->input('status');
            $nhahang->save();

            return redirect()->route('dsnhahang')->with('success', 'Cập nhật nhà hàng thành công.');
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
            'vung' => 'required|string|max:255',
            'nhathau' => 'required|string|max:255',
            'ruijie' => 'required|string|max:255',
            'daucam' => 'required|string|max:255',
            'matcam' => 'required|string|max:255',
            'ten' => 'required|string|max:255',
            'diachi' => 'required|string|max:255',
            'sdt' => 'required|string|max:15',
            'iptinh' => 'required|string|max:255',
            'ipmc' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ]);

        try {
            // Tự sinh ID
            $maxId = NhaHang::max('id');
            $newId = $maxId ? $maxId + 1 : 1;

            NhaHang::create([
                'id' => $newId,
                'vung' => $request->vung,
                'nhathau' => $request->nhathau,
                'ruijie' => $request->ruijie,
                'daucam' => $request->daucam,
                'matcam' => $request->matcam,
                'ten' => $request->ten,
                'diachi' => $request->diachi,
                'sdt' => $request->sdt,
                'iptinh' => $request->iptinh,
                'ipmc' => $request->ipmc,
                'status' => $request->status,
            ]);

            return redirect()->route('dsnhahang')->with('success', 'Nhà hàng đã được thêm mới!');

        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Không thể thêm nhà hàng: ' . $e->getMessage()]);
        }
    } 



    public function destroy($id)
    {
        $nhahang = NhaHang::find($id);
        if ($nhahang) {
            $nhahang->delete();
            return redirect()->route('dsnhahang')->with('success', 'Nhà hàng đã được xóa!');
        }
        return redirect()->route('dsnhahang')->with('error', 'Nhà hàng không tồn tại!');
    }
    
    public function export()
    {
        $nhahangs = nhahang::all(); // Lấy tất cả dữ liệu từ bảng Nhahang
        return Excel::download(new ExcelExport($nhahangs, 'nhahang'), 'nhahangs.xlsx');
    }

    public function checknhahang(Request $request)
    {
        $request->validate([
            'field' => 'required|string|max:255',
        ]);

        $exists = NhaHang::where('ten', $request->field)->exists();

        return response()->json(['exists' => $exists]);
    }

    
}