<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhaHang extends Model
{
    use HasFactory;
    public $timestamps = false;

    // Đặt tên bảng nếu khác với tên mặc định
    protected $table = 'nhahang';

    // Nếu bạn có cột tự động tăng, không cần khai báo
    protected $fillable = ['id','vung','nhathau','ruijie', 'daucam','matcam', 'ten', 'diachi', 'sdt', 'iptinh', 'ipmc', 'status'];
}
