<?php
namespace App\Http\Controllers\hping;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ping; // Thêm dòng này để sử dụng model Ping
use App\Models\tenmien;

class myPingController extends Controller
{
    public function index()
    {
        // Lấy dữ liệu từ bảng ping
        $mypings = ping::all(); // Lấy tất cả các bản ghi
        $tenmien = tenmien::all();
        return view('ping.ping', compact('mypings', 'tenmien'));
    }

    public function pingStatus(Request $request, $ip)
    {
        $port = $request->query('port');
        $status = $this->checkStatus($ip, $port) ? 'Online' : 'Offline';
        return response()->json(['status' => $status]);
    }

    private function checkStatus($ip, $port = null)
    {
        if ($port) {
            // Kiểm tra xem cổng có mở hay không
            return $this->checkPort($ip, $port);
        } else {
            // Kiểm tra trạng thái IP bằng ping
            return $this->ping($ip);
        }
    }

    private function ping($ip)
    {
        $output = [];
        $result = null;
        exec("ping -n 1 -w 1000 " . escapeshellarg($ip), $output, $result); // lệnh ping trên Windows
        return $result === 0;
    }

    private function checkPort($ip, $port)
    {
        $connection = @fsockopen($ip, $port, $errno, $errstr, 2);
        if ($connection) {
            fclose($connection);
            return true; // Port mở
        }
        return false; // Port đóng
    }


     public function edit($id)
    {
        $pings = ping::findOrFail($id);
        return view('ping.edit', compact('pings'));
    }

     public function edittm($id)
    {
        $tenmien = tenmien::findOrFail($id);
        return view('ping.edittm', compact('tenmien'));
    }

    // Cập nhật nhà hàng
    public function update(Request $request, $id)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'iptinh' => 'required|string|max:255',       
        ]);
        try {
            $mang = ping::findOrFail($id);
            $mang->nhahang = $request->input('nhahang');
            $mang->iptinh = $request->input('iptinh');
            $mang->save();

            return redirect()->route('ping')->with('success', 'Cập nhật ip thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
        }       
    }

    public function updatetm(Request $request, $id)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'tenmien' => 'required|string|max:255',       
        ]);
        try {
            $mang = tenmien::findOrFail($id);
            $mang->nhahang = $request->input('nhahang');
            $mang->tenmien = $request->input('tenmien');
            $mang->save();

            return redirect()->route('ping')->with('success', 'Cập nhật tên miền thành công.');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
        }       
    }

    

     public function create()
    {
        return view('ping.create'); // Tạo file view này
    }

     public function createtm()
    {
        return view('ping.createtm'); // Tạo file view này
    }

    // Phương thức store đã được cập nhật ở bước trước
    public function store(Request $request)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'iptinh' => 'required|string|max:255',
        ]);
    
        try {
            // Tự sinh ID
            $maxId = ping::max('id');
            $newId = $maxId ? $maxId + 1 : 1;

            ping::create([
                'id' => $newId,
                'nhahang' => $request->nhahang,
                'iptinh' => $request->iptinh,
            ]);

            return redirect()->route('ping')->with('success', 'Mạng đã được thêm mới!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
        }       
    }

    public function storetm(Request $request)
    {
        $request->validate([
            'nhahang' => 'required|string|max:255',
            'tenmien' => 'required|string|max:255',
        ]);
    
        try{ 
        // Tự sinh ID
            $maxId = tenmien::max('id');
            $newId = $maxId ? $maxId + 1 : 1;

            tenmien::create([
                'id' => $newId,
                'nhahang' => $request->nhahang,
                'tenmien' => $request->tenmien,
            ]);

            return redirect()->route('ping')->with('success', 'Tên miền đã được thêm mới!');
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Cập nhật thất bại: ' . $e->getMessage()]);
        }       
    }

    public function destroy($id)
    {
        $mang = ping::find($id);
        if ($mang) {
            $mang->delete();
            return redirect()->route('ping')->with('success', 'Mạng đã được xóa!');
        }
        return redirect()->route('ping')->with('error', 'Mạng không tồn tại!');
    }


    public function destroytm($id)
    {
        $mien = tenmien::find($id);
        if ($mien) {
            $mien->delete();
            return redirect()->route('ping')->with('success', 'Mạng đã được xóa!');
        }
        return redirect()->route('ping')->with('error', 'Mạng không tồn tại!');
    }
}