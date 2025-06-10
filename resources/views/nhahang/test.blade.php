@extends('master')

@section('title')
Danh sách nhà hàng
@endsection

@section('content')

<!-- Nút Thêm Mới -->
<a href="{{ route('nhahang.create') }}" class="btn btn-primary mb-3">Thêm Mới</a>

<!-- Form Edit -->
<div id="editFormContainer" style="display: none;">
    <h5>Edit Nhà Hàng</h5>
    <form id="editForm" action="" method="POST">
        @csrf
        <input type="hidden" name="id" id="editId">
        <div class="mb-3">
            <label for="ten" class="form-label">Tên</label>
            <input type="text" class="form-control" id="editTen" name="ten" required>
        </div>
        <div class="mb-3">
            <label for="diachi" class="form-label">Địa Chỉ</label>
            <input type="text" class="form-control" id="editDiachi" name="diachi" required>
        </div>
        <div class="mb-3">
            <label for="sdt" class="form-label">SĐT</label>
            <input type="text" class="form-control" id="editSdt" name="sdt" required>
        </div>
        <button type="submit" class="btn btn-primary">Lưu</button>
        <button type="button" class="btn btn-secondary" onclick="closeEditForm()">Hủy</button>
    </form>
</div>

<table class="table align-items-center mb-0" id="myTable">
    <thead>
        <tr>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nhà hàng</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Địa chỉ</th>
            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SĐT</th>
            <th class="text-secondary opacity-7"></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
</table>

<script>
    function openEditForm(id, ten, diachi, sdt) {
        document.getElementById('editFormContainer').style.display = 'block';
        document.getElementById('editId').value = id;
        document.getElementById('editTen').value = ten;
        document.getElementById('editDiachi').value = diachi;
        document.getElementById('editSdt').value = sdt;
        document.getElementById('editForm').action = `/hieu/public/nhahang/${id}/update`; // Cập nhật action của form
    }

    function closeEditForm() {
        document.getElementById('editFormContainer').style.display = 'none';
    }

    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

@endsection