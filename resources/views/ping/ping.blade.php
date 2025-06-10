@extends('master')

@section('title')
Danh sách mạng
@endsection

@section('content')

<!--<div>
    <p>Thời gian còn lại để refresh: <span id="countdown">20</span> giây</p>
</div> -->

<div class="col-md-6">
    <div class="card">

        <div class="card-header">
            <h4 class="card-title">Ping ip tĩnh</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select1"
                        class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>IP</th>
                            <th>Trạng thái</th>
                            <th>
                                <button class="btn btn-warning" onclick="window.location.href='{{ route('pingcreate') }}'">
                                    <span class="btn-label"><i class="fa fa-plus"></i></span>
                                    Thêm mới
                                </button>
                            </th>
                        </tr>
                    </thead>
                     <tfoot>
                    
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>IP</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($mypings as $index => $ping1)
                        <tr>
                            <td>{{ $ping1->id }}</td>
                            <td>{{ $ping1->nhahang }}</td>
                            <td>{{ $ping1->iptinh }}</td>
                            <td id="status-{{ $ping1->iptinh }}-{{ $index }}">
                                <!-- Trạng thái sẽ được cập nhật qua JavaScript -->
                            </td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn btn-link btn-primary btn-lg me-2" onclick="window.location='{{ route('ping.edit', $ping1->id) }}'" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('ping.destroy', $ping1->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Bạn có chắc chắn muốn xóa nhà hàng này?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ping tên miền</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="add-row"
                        class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên miền</th>
                            <th>Trạng thái</th>
                            <th>
                                <button class="btn btn-warning" onclick="window.location.href='{{ route('pingcreatetm') }}'">
                                    <span class="btn-label"><i class="fa fa-plus"></i></span>
                                    Thêm mới
                                </button>
                            </th>
                        </tr>
                    </thead>
                     <tfoot>
                    
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên miền</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($tenmien as $index1 => $tenmiens)
                        <tr>
                            <td>{{ $tenmiens->id }}</td>
                            <td>{{ $tenmiens->nhahang }}</td>
                            <td>{{ $tenmiens->tenmien }}</td>
                            <td id="status-{{ $tenmiens->tenmien }}-{{ $index1 }}">
                                <!-- Trạng thái sẽ được cập nhật qua JavaScript -->
                            </td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn btn-link btn-primary btn-lg me-2" onclick="window.location='{{ route('ping.edittm', $tenmiens->id) }}'" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('ping.destroytm', $tenmiens->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Bạn có chắc chắn muốn xóa tên miền này?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
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



<script>
document.addEventListener("DOMContentLoaded", function() {
    const ipList = @json($mypings->pluck('iptinh'));

    async function fetchData() {
        const fetchPromises = ipList.map(async (ipWithPort, index) => {
            const statusCellId = 'status-' + ipWithPort + '-' + index;

            // Tách IP và port nếu có
            const [ip, port] = ipWithPort.split(':');
            const url = `ping-status/${encodeURIComponent(ip)}${port ? '?port=' + encodeURIComponent(port) : ''}`;

            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error('Lỗi: ' + response.status);
                
                const data = await response.json();
                updateStatusCell(statusCellId, data.status);
            } catch (error) {
                console.error("Lỗi khi tải dữ liệu:", error);
            }
        });

        // Chờ tất cả các Promise hoàn thành
        await Promise.all(fetchPromises);
    }

    function updateStatusCell(statusCellId, status) {
        const statusCell = document.getElementById(statusCellId);
        if (statusCell) {
            statusCell.textContent = status;
            statusCell.className = status === 'Online' ? 'online' : 'offline';
            statusCell.style.fontWeight = "bold";

            // Đổi màu dựa trên trạng thái
            statusCell.style.color = status === 'Online' ? "green" : "red";
            statusCell.style.backgroundColor = status === 'Online' ? "transparent" : "yellow"; // Nếu Offline, đổi màu nền thành vàng
        } else {
            console.error(`Không tìm thấy phần tử với ID: ${statusCellId}`);
        }
    }

    fetchData(); // Gọi ngay khi trang tải
    setInterval(fetchData, 30000); // Refresh bảng mỗi 20 giây
});
</script>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const tmList = @json($tenmien->pluck('tenmien'));

    async function fetchData() {
        const fetchPromises = tmList.map(async (ipWithPort, index1) => {
            const statusCellId = 'status-' + ipWithPort + '-' + index1;

            // Tách IP và port nếu có
            const [ip, port] = ipWithPort.split(':');
            const url = `ping-status/${encodeURIComponent(ip)}${port ? '?port=' + encodeURIComponent(port) : ''}`;

            try {
                const response = await fetch(url);
                if (!response.ok) throw new Error('Lỗi: ' + response.status);
                
                const data = await response.json();
                updateStatusCell(statusCellId, data.status);
            } catch (error) {
                console.error("Lỗi khi tải dữ liệu:", error);
            }
        });

        // Chờ tất cả các Promise hoàn thành
        await Promise.all(fetchPromises);
    }

    function updateStatusCell(statusCellId, status) {
        const statusCell = document.getElementById(statusCellId);
        if (statusCell) {
            statusCell.textContent = status;
            statusCell.className = status === 'Online' ? 'online' : 'offline';
            statusCell.style.fontWeight = "bold";

            if (status === 'Online') {
                statusCell.style.color = "green";
                statusCell.style.backgroundColor = "transparent";
            } else {
                statusCell.style.color = "red";
                statusCell.style.backgroundColor = "yellow"; // Nếu Offline, đổi màu nền thành vàng
            }
        } else {
            console.error(`Không tìm thấy phần tử với ID: ${statusCellId}`);
        }
    }

    fetchData(); // Gọi ngay khi trang tải
    setInterval(fetchData, 30000); // Refresh bảng mỗi 20 giây
});
</script>

<!-- <script>
document.addEventListener("DOMContentLoaded", function() {
    let countdown = 20; // Thời gian đếm ngược (giây)
    const countdownDisplay = document.getElementById("countdown"); // Phần tử hiển thị đếm ngược

    async function fetchData() {
        const ipList = @json($mypings->pluck('iptinh'));

        for (let index = 0; index < ipList.length; index++) {
            const ipWithPort = ipList[index];
            const statusCellId = 'status-' + ipWithPort + '-' + index;

            const parts = ipWithPort.split(':');
            const ip = parts[0]; // IP
            const port = parts[1] || null; // Port (nếu có)

            if (port) {
                try {
                    let url = 'ping-status/' + encodeURIComponent(ip) + '?port=' + encodeURIComponent(port);
                    const response = await fetch(url);
                    if (!response.ok) {
                        throw new Error('Lỗi: ' + response.status);
                    }
                    const data = await response.json();

                    const statusCell = document.getElementById(statusCellId);
                    if (statusCell) {
                        statusCell.textContent = data.status;
                        statusCell.className = data.status === 'Online' ? 'online' : 'offline';
                        statusCell.style.fontWeight = "bold";
                        statusCell.style.color = data.status === 'Online' ? "green" : "red";
                    }
                } catch (error) {
                    console.error("Lỗi khi tải dữ liệu:", error);
                }
            }
        }
    }

    function startCountdown() {
        const interval = setInterval(() => {
            countdownDisplay.textContent = countdown;
            countdown--;

            if (countdown < 0) {
                clearInterval(interval);
                fetchData(); // Gọi lại hàm fetchData khi đếm ngược xong
                countdown = 20; // Reset lại đếm ngược
                startCountdown(); // Bắt đầu lại đếm ngược
            }
        }, 1000);
    }

    fetchData(); // Gọi ngay khi trang tải
    startCountdown(); // Bắt đầu đếm ngược
});
</script>  -->  




@endsection