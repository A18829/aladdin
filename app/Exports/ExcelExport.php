<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExcelExport implements FromCollection, WithHeadings
{
    private $data;
    private $type;

    public function __construct($data, $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    public function collection()
    {
        return collect($this->data->map(function ($item) {
            if ($this->type === 'mang') {
                return [
                    'id' => $item->id,
                    'nhahang' => $item->nhahang,
                    'nhamang' => $item->nhamang,
                    'men' => $item->men,
                    'account' => $item->account,
                    'pass' => $item->pass,
                    'diachi' => $item->diachi,
                ];
            } elseif ($this->type === 'nhahang') {
                return [
                    'id' => $item->id,
                    'vung' => $item->vung,
                    'nhathau' => $item->nhathau,
                    'ruijie' => $item->ruijie,
                    'daucam' => $item->daucam,
                    'matcam' => $item->matcam,
                    'ten' => $item->ten,
                    'diachi' => $item->diachi,
                    'iptinh' => $item->iptinh,
                    'ipmc' => $item->ipmc,
                    'status' => $item->status,
                ];
            } elseif ($this->type === 'camera') {
                return [
                    'id' => $item->id,
                    'nhahang' => $item->nhahang,
                    'domain' => $item->domain,
                    'port' => $item->port,
                    'httpport' => $item->httpport,
                    'user' => $item->user,
                    'pass' => $item->pass,
                    'passcam' => $item->passcam,
                ];
            }
        }));
    }

    public function headings(): array
    {
        if ($this->type === 'mang') {
            return [
                'ID',
                'Nhà hàng',
                'Nhà mạng',
                'MEN',
                'Account',
                'Pass',
                'Địa chỉ',
            ];
        } elseif ($this->type === 'nhahang') {
            return [
                'ID',
                'Vùng',
                'Nhà Thầu',
                'Ruijie',
                'Đầu Cam',
                'Mắt Cam',
                'Tên',
                'Địa Chỉ',
                'IP tĩnh',
                'IP máy chủ',
                'Trạng thái'
            ];
        }  elseif ($this->type === 'camera') {
            return [
                'ID',
                'Nhà hàng',
                'Tên miền',
                'SVR Port',
                'Http Port',
                'User',
                'Pass đầu ghi',
                'Pass cam',
            ];
        }

        return [];
    }
}