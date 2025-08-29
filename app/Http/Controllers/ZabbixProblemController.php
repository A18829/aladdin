<?php

namespace App\Http\Controllers;

use App\Services\ZabbixClient;

class ZabbixProblemController extends Controller
{
    protected $zabbixClient;

    public function __construct(ZabbixClient $zabbixClient)
    {
        $this->zabbixClient = $zabbixClient;
    }

    public function index()
    {
        // Lấy danh sách các vấn đề từ API Zabbix
        $problems = $this->zabbixClient->getProblems();

        // Lấy tên host cho từng vấn đề
        foreach ($problems as &$problem) {
            $problem['hostname'] = $this->zabbixClient->getHostById($problem['objectid']);
        }

        // Trả dữ liệu sang view
        return view('zabbix.problems', compact('problems'));
    }
}