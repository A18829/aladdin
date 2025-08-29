<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ZabbixClient
{
    protected $baseUrl;
    protected $authToken;

    public function __construct()
    {
        $this->baseUrl = 'http://hieunv.ddns.net:2025/zabbix/api_jsonrpc.php';
        $this->authToken = 'e253c16bce559c7160e4306c423f09c972f430b36a6b288c1fc77564c0108f88';
    }

    /**
     * Gửi yêu cầu tới API Zabbix
     */
    private function sendRequest($method, $params, $id = 1)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->authToken,
            'Content-Type' => 'application/json',
        ])->post($this->baseUrl, [
            'jsonrpc' => '2.0',
            'method' => $method,
            'params' => $params,
            'id' => $id,
        ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
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
                'acknowledged' => '0', // Chỉ lấy các vấn đề chưa được giải quyết
            ],
        ], 2); // Thay đổi id thành 2

        return $response['result'] ?? [];
    }

    /**
     * Lấy tên host từ hostid
     */
    public function getHostById($objectId)
    {
        $response = $this->sendRequest('trigger.get', [
            'output' => ['hostid'],
            'triggerids' => $objectId,
            'selectHosts' => ['host'],
        ]);

        if (isset($response['result'][0]['hosts'][0]['host'])) {
            return $response['result'][0]['hosts'][0]['host'];
        }

        return 'Unknown';
    }
}