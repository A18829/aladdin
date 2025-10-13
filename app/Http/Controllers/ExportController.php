<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\pdf; // Đảm bảo đúng namespace
use Illuminate\Http\Request;

use App\Models\Nhahang; 
use App\Models\Mang; 
use App\Models\Camera; 

class ExportController extends Controller
{
    public function nhahangPDF()
    {
        // Lấy tất cả nhà hàng từ cơ sở dữ liệu
        $nhahangs = Nhahang::all();

        $data = [
            'title' => 'Aladdin - Danh sách nhà hàng',
            'date' => now()->format('d/m/Y'),
            'rows' => $nhahangs->map(function($nhahang) {
                return [
                    'ID' => $nhahang->id,
                    'Thương hiệu' => $nhahang->vung,
                    'Nhà thầu' => $nhahang->nhathau,
                    'Ruijie'=> $nhahang->ruijie == 1 ? 'Có' : 'Không',
                    'Đầu cam' => $nhahang->daucam,
                    'Mắt cam' => $nhahang->matcam,
                    'Tên' => $nhahang->ten,
                    'Địa chỉ' => $nhahang->diachi,
                    'Ip tĩnh' => $nhahang->iptinh,
                    'Ip máy chủ' => $nhahang->ipmc,
                    'Trạng thái' => $nhahang->status == 1 ? 'Hoạt động' : ($nhahang->status == 2 ? 'Sắp hoạt động' : 'Không hoạt động'),
                ];
            })
        ];

        // Tạo PDF từ view
       
        $pdf = PDF::loadView('exports.nhahangpdf', $data)
           ->setPaper('A4', 'landscape'); // Hoặc 'portrait'
        // Tải xuống tệp PDF
        return $pdf->download('baocao_nhahang.pdf');
    }

    public function mangPDF()
    {
        // Lấy tất cả nhà hàng từ cơ sở dữ liệu
        $mangs = mang::all();

        $data = [
            'title' => 'Aladdin - Danh sách đường truyền',
            'date' => now()->format('d/m/Y'),
            'rows' => $mangs->map(function($mang) {
                return [
                    'ID' => $mang->id,
                    'Nhà hàng' => $mang->nhahang,
                    'Nhà mạng' => $mang->nhamang,
                    'Men'=> $mang->men,
                    'Account' => $mang->account,
                    'Pass' => $mang->pass,
                    'Địa chỉ' => $mang->diachi,
                ];    
            })
        ];

        // Tạo PDF từ view
       
        $pdf = PDF::loadView('exports.mangpdf', $data)
           ->setPaper('A4', 'landscape'); // Hoặc 'portrait'
        // Tải xuống tệp PDF
        return $pdf->download('baocao_mang.pdf');
    }

    public function cameraPDF()
    {
        // Lấy tất cả nhà hàng từ cơ sở dữ liệu
        $cameras = camera::all();

        $data = [
            'title' => 'Aladdin - Tài khoản camera',
            'date' => now()->format('d/m/Y'),
            'rows' => $cameras->map(function($camera) {
                return [
                    'ID' => $camera->id,
                    'Nhà hàng' => $camera->nhahang,
                    'Domain' => $camera->domain,
                    'Ip tĩnh' => $camera->iptinh,
                    'SVR port' => $camera->port,
                    'Http port'=> $camera->httpport,
                    'Rtsp port'=> $camera->rtspport,
                    'User' => $camera->user,
                    'Pass' => $camera->pass,
                    'Passcam' => $camera->passcam,
                ];    
            })
        ];

        // Tạo PDF từ view
       
        $pdf = PDF::loadView('exports.camerapdf', $data)
           ->setPaper('A4', 'landscape'); // Hoặc 'portrait'
        // Tải xuống tệp PDF
        return $pdf->download('baocao_camera.pdf');
    }


}