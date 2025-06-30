@extends('master')

@section('title')
Danh sách mạng
@endsection

@section('content')

<div class="col-md-6">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Ping ip tĩnh: (Nền xanh: fail 1 lần. Nền vàng: fail >= 2 lần)</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                 <a href="{{ route('ip.export') }}" class="badge badge-success mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>
                <table id="multi-filter-select1" class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>IP</th>
                            <th>Trạng thái</th>
                            <th>
                                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('pingcreate') }}'">
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
                            <td id="status-{{ $ping1->iptinh }}-{{ $index }}"></td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class=" btn-link btn-primary me-4 " onclick="window.location='{{ route('ping.edit', $ping1->id) }}'">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('ping.destroy', $ping1->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class=" btn-link btn-danger me-4" onclick="return confirm('Bạn có chắc chắn muốn xóa nhà hàng này?')">
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
                <a href="{{ route('tm.export') }}" class="badge badge-success mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>    
                <table id="add-row" class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Tên miền</th>
                            <th>Trạng thái</th>
                            <th>
                                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('pingcreatetm') }}'">
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
                            <td id="status-{{ $tenmiens->tenmien }}-{{ $index1 }}"></td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn-link btn-primary me-4" onclick="window.location='{{ route('ping.edittm', $tenmiens->id) }}'">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('ping.destroytm', $tenmiens->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-link btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa tên miền này?')">
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
    document.addEventListener("DOMContentLoaded", function () {
        const ipList = @json($mypings->pluck('iptinh'));
        const tmList = @json($tenmien->pluck('tenmien'));

        const statusCache = {}; // Lưu trạng thái để tránh ghi đè không cần thiết
        const failureCount = {};

        function setPingingStyle(cell) {
            cell.style.backgroundColor = 'lightblue';
        }

        function updateStatusCell(cellId, status) {
            const cell = document.getElementById(cellId);
            if (!cell) return;

            // Lưu trạng thái trước đó để kiểm tra thay đổi
            if (statusCache[cellId] !== status) {
                statusCache[cellId] = status;
                cell.textContent = status;
                cell.style.fontWeight = 'bold';
                cell.style.color = status === 'Online' ? 'green' : 'red';
            }

            // Cập nhật màu nền theo trạng thái (nhưng KHÔNG khi đang ping)
            if (status === 'Online') {
                cell.style.backgroundColor = 'white';
            } else if (failureCount[cellId] >= 2) {
                cell.style.backgroundColor = 'yellow';
            }
        }

        async function pingHost(host, index, prefix) {
            const [base, port] = host.split(':');
            const url = `ping-status/${encodeURIComponent(base)}${port ? '?port=' + encodeURIComponent(port) : ''}`;
            const cellId = `status-${host}-${index}`;
            const cell = document.getElementById(cellId);

            if (cell) setPingingStyle(cell); // ✅ tô nền xanh khi đang ping

            try {
                const res = await fetch(url);
                const data = await res.json();

                if (data.status === 'Online') {
                    failureCount[cellId] = 0;
                } else {
                    failureCount[cellId] = (failureCount[cellId] || 0) + 1;
                }

                updateStatusCell(cellId, data.status);
            } catch (e) {
                failureCount[cellId] = (failureCount[cellId] || 0) + 1;
                updateStatusCell(cellId, 'Offline');
            }
        }

        async function pingQueue(list, prefix) {
            let i = 0;
            while (true) {
                if (list.length === 0) break;
                await pingHost(list[i], i, prefix);
                i = (i + 1) % list.length;
                await new Promise(resolve => setTimeout(resolve, 100)); // để dễ thấy màu hơn
            }
        }

        pingQueue(ipList, 'ip');
        pingQueue(tmList, 'tm');
    });
</script>

@endsection