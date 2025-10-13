@extends('master')

@section('title')
Danh sách người dùng
@endsection

@section('content')

<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Danh sách người dùng</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="multi-filter-select" class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Username/email</th>
                            <th>Level</th>
                            <th>Status</th>
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
                            <th>Tên</th>
                            <th>Username/email</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->level }}</td>
                            <td>{{ $user->status }}</td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn btn-link btn-primary me-2" onclick="window.location='{{ route('user.edit', $user->id) }}'" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>
                                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline;">
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

<!-- Modal -->
<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('user.store') }}" method="POST">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Thêm mới người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Tên</label>
                            <input type="text" class="form-control" name="name" required>
                            <label>Username/Email</label>
                            <input type="text" class="form-control" name="email" required>
                            <label>Password</label>
                            <input type="text" class="form-control" name="password" required>
                            
                        </div>
                        <div class="col-md-6">
                            <label>Level</label>
                            <select class="form-select" name="level">
                                <option value="1">Admin</option>
                                <option value="2">Sub admin</option>
                                <option value="3">User</option>
                            </select>
                            <label>Status</label>
                            <select class="form-select" name="status">
                                <option value="1">Active</option>
                                <option value="0">Deactive</option>
                            </select>
                            
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
                url: '{{ route('check.user') }}',
                method: 'POST',
                data: {
                    field: fieldValue,
                    _token: '{{ csrf_token() }}' // Đảm bảo có CSRF token
                },
                success: function(response) {
                    if (response.exists) {
                        $('#error-message').text('Người dùng đã tồn tại!').show();
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