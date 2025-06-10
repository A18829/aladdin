@extends('master')

@section('title')
Thêm Mới Mạng
@endsection

@section('content')

<h5>Thêm Mới Mạng</h5>


<form action="{{ route('mang.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nhahang" class="form-label">Nhà hàng</label>
        <input type="text" class="form-control" id="nhahang" name="nhahang" required>
    </div>
    <div class="mb-3">
        <label for="nhamang" class="form-label">Nhà mạng</label>
        <input type="text" class="form-control" id="nhamang" name="nhamang" required>
    </div>
    <div class="mb-3">
        <label for="men" class="form-label">MEN</label>
        <input type="text" class="form-control" id="men" name="men" required>
    </div>
    <div class="mb-3">
        <label for="account" class="form-label">Account</label>
        <input type="text" class="form-control" id="account" name="account" required>
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Pass</label>
        <input type="text" class="form-control" id="pass" name="pass" required>
    </div>
    <div class="mb-3">
        <label for="diachi" class="form-label">Địa Chỉ</label>
        <input type="text" class="form-control" id="diachi" name="diachi" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="{{ route('dsmang') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection