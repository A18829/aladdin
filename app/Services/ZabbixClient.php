<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZabbixClient
{
    protected $baseUrl;
    protected $authToken;

    public function __construct()
    {
        $this->baseUrl = 'http://zb.hieunv.click/api_jsonrpc.php';
        $this->authToken = '5db3af300ce99a3bf671b7af4cc88cb2a5702dfa1ad07e16a9dc0b95cb5fcb35';
    }

    /**
     * Gửi yêu cầu tới API Zabbix
     */
    private function sendRequest($method, $params, $id = 1)
    {
        $response = Http::timeout(10)->withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken,
            'Content-Type'  => 'application/json',
        ])->post($this->baseUrl, [
            'jsonrpc' => '2.0',
            'method'  => $method,
            'params'  => $params,
            'id'      => $id,
        ]);

        $data = $response->json();

        // 👉 thêm debug lỗi (rất quan trọng)
        if (!$response->successful() || isset($data['error'])) {
            dd([
                'status' => $response->status(),
                'response' => $data
            ]);
        }

        return $data;
    }

    /**
     * Lấy danh sách các vấn đề chưa được giải quyết
     */
    public function getProblems()
    {
        $response = $this->sendRequest('problem.get', [
            'output' => 'extend',
            'selectAcknowledges' => 'extend',
            'selectTags' => 'extend',
            'sortfield' => ['eventid'],
            'sortorder' => 'DESC',
            'limit' => 500,
            'filter' => [
                'acknowledged' => '0',
            ],
        ], 2);

        return $response['result'] ?? [];
    }

    /**
     * Lấy tên host từ triggerid
     */
    public function getHostById($objectId)
    {
        $response = $this->sendRequest('trigger.get', [
            'output' => [],
            'triggerids' => [$objectId], // ✅ FIX QUAN TRỌNG
            'selectHosts' => ['host'],
        ]);

        return $response['result'][0]['hosts'][0]['host'] ?? 'Unknown';
    }
}