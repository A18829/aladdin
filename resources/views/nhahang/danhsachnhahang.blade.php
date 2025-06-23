@extends('master')

@section('title')
Danh sách nhà hàng
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách nhà hàng</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('nhahangs.export') }}" class="badge badge-black mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>
                <table id="multi-filter-select" class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Thương hiệu</th>
                            <th>Nhà Thầu</th>
                            <th>Ruijie: {{ $nhahangs->sum('ruijie') }}</th>
                            <th>Đầu cam: {{ $nhahangs->sum('daucam') }}</th>
                            <th>Mắt cam: {{ $nhahangs->sum('matcam') }}</th>
                            <th>Nhà hàng: {{ $nhahangs->count('nhahang') }} </th>
                            <th>Địa chỉ</th>                          
                            <th>Ip tĩnh</th>
                            <th>Ip máy chủ</th>
                            <th >Trạng thái {{ $nhahangs->where('status', 1)->count() }}+{{ $nhahangs->where('status', 2)->count() }}+{{ $nhahangs->where('status', 0)->count() }}</th>
                            <th>
                                <button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('nhahangcreate') }}'">
                                    <span class="btn-label"><i class="fa fa-plus"></i></span>
                                     Thêm mới
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Thương hiệu</th>
                            <th>Nhà Thầu</th>
                            <th>Ruijie</th>
                            <th>Đầu cam</th>
                            <th>Mắt cam</th>
                            <th>Nhà hàng</th>
                            <th>Địa chỉ</th>                          
                            <th>Ip tĩnh</th>
                            <th>Ip máy chủ</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($nhahangs as $nhahang)
                        <tr>
                            <td>{{ $nhahang->id }}</td>
                            <td>{{ $nhahang->vung }}</td>
                            <td>{{ $nhahang->nhathau }}</td>
                            <td>     
                                @if ($nhahang->ruijie == 1)
                                    <span class="badge badge-success">Có GW</span>
                                @else
                                    <span class="badge badge-danger">Không GW</span>
                                @endif
                            </td>
                            <td>{{ $nhahang->daucam }}</td>
                            <td>{{ $nhahang->matcam }}</td>
                            <td>{{ $nhahang->ten }}</td>
                            <td>{{ $nhahang->diachi }}</td>                  
                            <td>{{ $nhahang->iptinh }}</td>
                            <td>{{ $nhahang->ipmc }}</td>
                            <td>
                                @if ($nhahang->status == 1)
                                    <span class="badge badge-success">Hoạt động</span>
                                @elseif ($nhahang->status == 2)
                                    <span class="badge badge-warning">Sắp hoạt động</span>
                                @else
                                    <span class="badge badge-danger">Không hoạt động </span>
                                @endif
                            </td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn btn-link btn-primary me-2" onclick="window.location='{{ route('nhahang.edit', $nhahang->id) }}'" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('nhahang.destroy', $nhahang->id) }}" method="POST" style="display: inline;">
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

<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });

</script>



@endsection