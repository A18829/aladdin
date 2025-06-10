<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IpStatusController extends Controller
{
    protected $ip_list = [


["ip" => "123.16.54.224", "name" => "VP69 1.1"],

["ip" => "171.244.236.55", "name" => "VP Bo1SG"],

["ip" => "14.224.130.215", "name" => "Bep TTSG"],

["ip" => "14.232.210.101", "name" => "bo1hn"],

["ip" => "botod17.cameraddns.net", "name" => "bo2hn ip dong T1 ORDER"],

["ip" => "botod17.cameraddns.net", "name" => "bo2hn ip dong port:8009", "port" => 8009],

["ip" => "14.232.210.84", "name" => "bo2hn ip tinh wifi T4"],

["ip" => "14.224.194.89", "name" => "bo2hn ip tinh wifi T4 moi"],

["ip" => "115.78.4.157", "name" => "bo3hn"],

["ip" => "14.248.90.140", "name" => "bo4hn"],

["ip" => "123.16.32.72", "name" => "bo5hn"],

["ip" => "222.252.22.15", "name" => "bo6hn"],

["ip" => "222.252.22.15", "name" => "bo6hn PORT: 8001", "port" => 8001],

["ip" => "123.16.189.146", "name" => "bo7hn PORT: 8000", "port" => 8000], // Kiểm tra cổng 8000

["ip" => "14.224.148.230", "name" => "bo8hn"],

["ip" => "14.224.152.230", "name" => "bo9hn"],

["ip" => "14.224.157.113", "name" => "bo10hn ip tinh order chặn ping"],

["ip" => "14.160.23.61", "name" => "bo10hn ip tinh camera"],

["ip" => "113.190.233.20", "name" => "bo11hn"],

["ip" => "14.224.152.173", "name" => "bo15hn"],

["ip" => "14.224.154.28", "name" => "bo12hy"],

["ip" => "14.224.150.127", "name" => "bo12hy"],

["ip" => "171.224.241.148", "name" => "bo1sg"],

["ip" => "27.74.247.129", "name" => "bo2sg"],

["ip" => "115.78.4.157", "name" => "bo3sg"],

["ip" => "115.79.4.176", "name" => "bo4sg"],

["ip" => "14.224.161.234", "name" => "bo5sg"],

["ip" => "14.224.172.244", "name" => "bo5sg"],

["ip" => "14.224.168.96", "name" => "bo7sg"],

["ip" => "14.224.169.167", "name" => "bo7sg"],

["ip" => "14.224.218.109", "name" => "bo8sg"],

["ip" => "14.162.146.243", "name" => "lw1hn"],

// ["ip" => "14.162.147.67", "name" => "lw1hn-KH"],

["ip" => "14.224.207.79", "name" => "lw1hn KH moi"],

["ip" => "14.224.194.68", "name" => "lw1hn moi"],

["ip" => "14.224.144.63", "name" => "lw2hn"],

["ip" => "14.224.157.218", "name" => "lw2hn"],

["ip" => "14.224.156.121", "name" => "lw3hn"],

["ip" => "14.224.156.142", "name" => "lw3hn"],

["ip" => "27.72.97.95", "name" => "lw6hn"],

["ip" => "14.224.150.124", "name" => "lw7hn"],

["ip" => "14.224.152.91", "name" => "lw7hn"],

["ip" => "14.224.195.83", "name" => "lw8hn"],

["ip" => "14.224.138.24", "name" => "lw9hn"],

["ip" => "14.224.194.231", "name" => "lw10hn"],

["ip" => "14.224.139.152", "name" => "lw11hn"],

["ip" => "14.224.195.119", "name" => "lw12hn"],

["ip" => "14.224.136.201", "name" => "lw15hn"],

["ip" => "14.224.198.140", "name" => "lw16hn"],

["ip" => "14.224.190.229", "name" => "lw17hn"],

["ip" => "14.224.142.14", "name" => "lw18hn"],

["ip" => "14.224.136.152", "name" => "lw1bg"],

["ip" => "14.224.138.195", "name" => "lw1hp"],

["ip" => "14.224.188.160", "name" => "lw2hp"],

["ip" => "14.224.160.72", "name" => "lw1sg"],

["ip" => "222.255.200.210", "name" => "lw2sg"],

["ip" => "14.224.134.149", "name" => "lw3sg"],

["ip" => "14.224.139.142", "name" => "lw4sg"],

["ip" => "14.224.163.128", "name" => "lw5sg"],

["ip" => "14.224.169.107", "name" => "lw6sg"],

["ip" => "14.224.209.158", "name" => "lw7sg"],

// ["ip" => "lw8sg.ruijieddns.com", "name" => "lw8sg"],

["ip" => "171.224.241.0", "name" => "lw8sg"],

["ip" => "14.224.183.239", "name" => "tl1hn"],

["ip" => "14.224.190.233", "name" => "tl2hn"],

["ip" => "14.224.162.192", "name" => "av1sg"],

["ip" => "14.224.172.208", "name" => "av1sg"],

["ip" => "comnieu1124.ddns.net", "name" => "HS1HN"]


    ];

   public function pingView()
{
    return view('ping');
}

    public function getIpStatus()
    {
        $data = [];

        foreach ($this->ip_list as $entry) {
            if (isset($entry["port"])) {
                $entry["status"] = $this->checkPort($entry["ip"], $entry["port"]);
            } else {
                $entry["status"] = $this->ping($entry["ip"]);
            }
            $data[] = $entry;
        }

        return response()->json($data);
    }

    private function ping($ip)
    {
        $output = [];
        $result = null;
        exec("ping -n 1 -w 1000 " . escapeshellarg($ip), $output, $result);
        return $result === 0;
    }

    private function checkPort($ip, $port)
    {
        $connection = @fsockopen($ip, $port, $errno, $errstr, 2);
        if ($connection) {
            fclose($connection);
            return true;
        }
        return false;
    }
}