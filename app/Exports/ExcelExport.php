<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
class ExcelExport implements FromCollection, WithHeadings, WithEvents
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
                    'ruijie' => $item->ruijie == 1 ? 'Có' : 'Không',
                    'daucam' => $item->daucam,
                    'matcam' => $item->matcam,
                    'ten' => $item->ten,
                    'diachi' => $item->diachi,
                    'iptinh' => $item->iptinh,
                    'ipmc' => $item->ipmc,
                    'status' => $item->status == 1 ? 'Hoạt động' : ($item->status == 2 ? 'Sắp hoạt động' : 'Không hoạt động'),
                ];
            } elseif ($this->type === 'camera') {
                return [
                    'id' => $item->id,
                    'nhahang' => $item->nhahang,
                    'domain' => $item->domain,
                    'iptinh' => $item->iptinh,
                    'port' => $item->port,
                    'httpport' => $item->httpport,
                    'rtspport' => $item->rtspport,
                    'user' => $item->user,
                    'pass' => $item->pass,
                    'passcam' => $item->passcam,
                ];
            } elseif ($this->type === 'iptinh') {
                return [
                    'id' => $item->id,
                    'nhahang' => $item->nhahang,
                    'iptinh' => $item->iptinh,
                ];
            } elseif ($this->type === 'tenmien') {
                return [
                    'id' => $item->id,
                    'nhahang' => $item->nhahang,
                    'tenmien' => $item->tenmien,
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
                'Ip tĩnh',
                'SVR Port',
                'Http Port',
                'Rtsp Port',
                'User',
                'Pass đầu ghi',
                'Pass cam',
            ];
        }  elseif ($this->type === 'iptinh') {
            return [
                'ID',
                'Nhà hàng',
                'Ip tĩnh',
            ];
        }
        elseif ($this->type === 'tenmien') {
            return [
                'ID',
                'Nhà hàng',
                'Tên miền',
            ];
        }

        return [];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                // Định dạng tiêu đề
                $event->sheet->getStyle('A1:K1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1:K1')->getFont()->setSize(12);
                $event->sheet->getStyle('A1:K1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                $event->sheet->getStyle('A1:K1')->getFill()->getStartColor()->setARGB('FFCCCCCC');

                // Đặt border cho tất cả các ô trong bảng
                $event->sheet->getStyle('A1:K' . (count($this->data) + 1))
                    ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

                // Tự động điều chỉnh chiều rộng cột
                foreach (range('A', 'K') as $columnID) {
                    $event->sheet->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}