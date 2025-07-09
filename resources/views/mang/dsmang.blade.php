@extends('master')

@section('title')
Danh sách đường truyền internet
@endsection

@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Danh sách đường truyền - MST: 0107742477</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('mangs.export') }}" class="badge badge-black mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>
                <a href="{{ route('mangs.pdf') }}" class="badge badge-warning mb-3"><i class="fa icon-cloud-download"></i> Xuất PDF</a>
                <table id="multi-filter-select"
                        class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhà hàng</th>
                            <th>Nhà mạng</th>
                            <th>MEN</th>
                            <th>Account</th>
                            <th>Pass</th>
                            <th>Địa chỉ</th>
                            <th><button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('mangcreate') }}'">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Thêm mới
                </button></th>
                        </tr>
                    </thead>
                     <tfoot>
                    
                        <tr>
                            <th>ID</th>
                            <th>Nhà hàng</th>
                            <th>Nhà mạng</th>
                            <th>MEN</th>
                            <th>Account</th>
                            <th>Pass</th>
                            <th>Địa chỉ</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($mangs as $mang)
                        <tr>
                            <td>{{ $mang->id }}</td>
                            <td>{{ $mang->nhahang }}</td>
                            <td>{{ $mang->nhamang }}</td>
                            <td>{{ $mang->men }}</td>
                            <td>{{ $mang->account }}</td>
                            <td>{{ $mang->pass }}</td>
                            <td>{{ $mang->diachi }}</td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn btn-link btn-primary me-2" onclick="window.location='{{ route('mang.edit', $mang->id) }}'" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <form action="{{ route('mang.destroy', $mang->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            data-bs-toggle="tooltip"
                                            title=""
                                            class="btn btn-link btn-danger"
                                            data-original-title="Remove" onclick="return confirm('Bạn có chắc chắn muốn xóa mạng này?')">
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

@endsection