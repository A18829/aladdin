<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class LogsExport implements FromCollection
{
    protected $logs;

    public function __construct($logs)
    {
        $this->logs = $logs;
    }

    public function collection()
    {
        // Chuyển đổi logs thành mảng 2 chiều
        $data = [];
        foreach ($this->logs as $log) {
            $data[] = [$log]; // Mỗi log là một hàng trong Excel
        }
        return collect($data); // Trả về một collection
    }
}