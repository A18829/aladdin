@extends('master')

@section('title')
Danh sách mạng
@endsection

@section('content')



<div class="col-md-12">
    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Logs đăng nhập</h4>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                
                <a href="{{ route('logs.export') }}" class="badge badge-black mb-3"><i class="fa icon-cloud-download"></i> Xuất Logs</a>    
                <table id="multi-filter-select"
                        class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                         <thead>
                        <tr>
                            <th>Thời gian</th>
                            <th>Thông tin</th>
                        </tr>
                    </thead>
                    <tbody id="logs-body">
                        @foreach ($logs as $log)
                            <?php
                                preg_match('/\[(.*?)\]/', $log, $matches);
                                $timestamp = isset($matches[1]) ? $matches[1] : null;
                                $message = substr($log, strpos($log, ']') + 2);
                                $formattedTime = $timestamp ? \Carbon\Carbon::parse($timestamp)->toDateTimeString() : 'Invalid Date';
                            ?>
                            <tr>
                                <td>{{ $formattedTime }}</td>
                                <td>{{ $message }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
<!--<script>
    function fetchLogs() {
        fetch('{{ route('logs.data') }}')
            .then(response => response.json())
            .then(data => {
                const tbody = document.getElementById('logs-body');
                tbody.innerHTML = ''; // Xóa nội dung cũ

                data.forEach(log => {
                    const matches = log.match(/\[(.*?)\]/);
                    const timestamp = matches ? matches[1] : 'Invalid Date';
                    const message = log.substring(log.indexOf(']') + 2);
                    const formattedTime = new Date(timestamp).toLocaleString();

                    tbody.innerHTML += `
                        <tr>
                            <td>${formattedTime}</td>
                            <td>${message}</td>
                        </tr>
                    `;
                });
            })
            .catch(error => console.error('Error fetching logs:', error));
    }

    // Cập nhật bảng mỗi 5 giây
    setInterval(fetchLogs, 5000);
</script> -->

@endsection