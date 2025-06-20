@extends('master')

@section('title')
Danh sách nhà hàng
@endsection

@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Tài Khoản Camera</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('cameras.export') }}" class="badge badge-black mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>
                <table id="multi-filter-select" class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhà hàng</th>
                            <th>Tên miền</th>
                            <th>Port</th>
                            <th>User</th>
                            <th>Pass</th>
                            <th>Passcam</th>
                            <th>
                                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('cameracreate') }}'">
                                    <span class="btn-label"><i class="fa fa-plus"></i></span>
                                    Thêm mới
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Nhà hàng</th>
                            <th>Tên miền</th>
                            <th>Port</th>
                            <th>User</th>
                            <th>Pass</th>
                            <th>Passcam</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($cameras as $camera)
                        <tr>
                            <td>{{ $camera->id }}</td>
                            <td>{{ $camera->nhahang }}</td>
                            <td>{{ $camera->domain }}</td>
                            <td>{{ $camera->port }}</td>
                            <td>{{ $camera->user }}</td>
                            <td>{{ $camera->pass }}</td>
                            <td>{{ $camera->passcam }}</td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn btn-link btn-primary me-2" onclick="window.location='{{ route('camera.edit', $camera->id) }}'" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('camera.destroy', $camera->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove" onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này?')">
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