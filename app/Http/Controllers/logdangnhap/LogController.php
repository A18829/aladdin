<?php

namespace App\Http\Controllers\logdangnhap;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LogsExport;
use App\Exports\ExcelExport;

class LogController extends Controller
{
    
    public function index()
    {
        // Đọc file log
        $logFile = storage_path('logs/login.log');
        $logs = file($logFile); // Đọc toàn bộ file vào mảng

        return view('logdangnhap.index', compact('logs'));
    }

    public function fetchLogs()
    {
        $logFile = storage_path('logs/login.log');
        $logs = file($logFile);
        return response()->json($logs);
    }
    public function exportLogs()
    {
        $logFile = storage_path('logs/login.log');
        $logs = file($logFile);
        
        return Excel::download(new LogsExport($logs), 'logs.xlsx');
    }
}
