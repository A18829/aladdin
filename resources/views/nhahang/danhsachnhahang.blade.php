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
                <a href="{{ route('nhahangs.export') }}" class="badge badge-success mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>
                <a href="{{ route('nhahangs.pdf') }}" class="badge badge-warning mb-3"><i class="fa icon-cloud-download"></i> Xuất PDF</a>
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
                                <!--<button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('nhahangcreate') }}'">
                                    <span class="btn-label"><i class="fa fa-plus"></i></span>
                                    Thêm mới
                                </button>-->
                                <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
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
                                    Có GW
                                @else
                                    Không GW
                                @endif
                            </td>
                            <td>{{ $nhahang->daucam }}</td>
                            <td>{{ $nhahang->matcam }}</td>
                            <td>{{ $nhahang->ten }}</td>
                            <td>{{ $nhahang->diachi }}</td>                  
                            <td>{{ $nhahang->iptinh }}</td>
                            <td>{{ $nhahang->ipmc }}</td>
                            <td class="@if ($nhahang->status == 1) bg-success @elseif ($nhahang->status == 2) bg-warning @else bg-danger @endif">
                                @if ($nhahang->status == 1)
                                    Hoạt động
                                @elseif ($nhahang->status == 2)
                                    Sắp hoạt động
                                @else
                                    Không hoạt động 
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

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('nhahang.store') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Thêm mới nhà hàng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Thương hiệu</label>
                            <select class="form-select" name="vung">
                                @foreach($thuonghieu as $thuonghieus)
                                    <option value="{{ $thuonghieus->thuonghieu }}">{{ $thuonghieus->thuonghieu }}</option>
                                @endforeach
                            </select>
                            <label>Nhà thầu</label>
                            <select class="form-select" name="nhathau">
                                @foreach($nhathaus as $nhathauss)
                                  <option value="{{ $nhathauss->nhathau }}">{{ $nhathauss->nhathau }}</option>
                                @endforeach
                            </select>
                            <label>Ruijie</label>
                            <select class="form-select" name="ruijie">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>
                            <label>Đầu cam</label>
                            <input type="number" class="form-control" name="daucam" required>
                            <label>Mắt cam</label>
                            <input type="number" class="form-control" name="matcam" required>
                        </div>
                        <div class="col-md-6">
                            <label>Tên</label>
                            <input type="text" class="form-control" id="ten" name="ten" value="{{ old('ten') }}" required>
                            <div id="error-message" style="color: red; display: none;"></div>
                            <label>Địa chỉ</label>
                            <input type="text" class="form-control" name="diachi" required>
                            <label>Trạng thái</label>
                            <select class="form-select" name="status">
                                <option value="1">Hoạt động</option>
                                <option value="2">Sắp hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>
                            <label>SĐT</label>
                            <input type="text" class="form-control" name="sdt" required>
                            <label>IP tĩnh</label>
                            <input type="text" class="form-control" name="iptinh" required>
                            <label>IP máy chủ</label>
                            <input type="text" class="form-control" name="ipmc" required>
                        </div>
                    </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn btn-primary">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ten').on('blur', function() { // Thay '#ten' bằng ID của trường bạn muốn kiểm tra
            var fieldValue = $(this).val();

            $.ajax({
                url: '{{ route('check.nhahang') }}',
                method: 'POST',
                data: {
                    field: fieldValue,
                    _token: '{{ csrf_token() }}' // Đảm bảo có CSRF token
                },
                success: function(response) {
                    if (response.exists) {
                        $('#error-message').text('Nhà hàng đã tồn tại!').show();
                    } else {
                        $('#error-message').text('').hide();
                    }
                },
                error: function(xhr) {
                    console.error(xhr);
                }
            });
        });
    });
</script>
@endsection