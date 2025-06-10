<?php
namespace App\Http\Controllers\dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\mang;
use App\Models\nhahang;
use Illuminate\Support\Facades\DB; // Thêm dòng này để sử dụng DB



class dashboardcontroller extends Controller
{

   public function index()
    {
        // Lấy dữ liệu từ bảng nhahang, nhóm theo vung và đếm số lượng
        $data = Nhahang::select('vung', 
                                DB::raw('count(*) as count'),
                                DB::raw('SUM(ruijie) as ruijie'),
                                DB::raw('SUM(daucam) as daucam'),
                                DB::raw('SUM(matcam) as matcam'),
                                DB::raw('SUM(CASE WHEN status = 1 THEN 1 ELSE 0 END) as stt1'),
                                DB::raw('SUM(CASE WHEN status = 0 THEN 1 ELSE 0 END) as stt0'))
            ->groupBy('vung')
            ->get();

        $rj = Nhahang::select('ruijie', 
                                DB::raw('count(*) as count'))
            ->groupBy('ruijie')
            ->get(); 

        $nhathau = Nhahang::select('nhathau', 
                                DB::raw('count(*) as count'))
            ->groupBy('nhathau')
            ->get();       
         // Lấy tổng của các trường daucam, matcam, và ruijie
        $tong = Nhahang::select(
                    DB::raw('count(id) as total_nhahang'),
                    DB::raw('SUM(daucam) as total_daucam'),
                    DB::raw('SUM(matcam) as total_matcam'),
                    DB::raw('SUM(ruijie) as total_ruijie')
                )->first(); // Sử dụng first() để lấy một bản ghi duy nhất

        $nhamang = mang::select('nhamang', 
                                DB::raw('count(*) as count'))
            ->groupBy('nhamang')
            ->get(); 
        // Trả về view với dữ liệu
        return view('dashboard.db', compact('data','tong','rj','nhathau','nhamang'));
        var_dump($nhamang);
    }

}