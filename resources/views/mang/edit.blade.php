@extends('master')

@section('title')
Sửa đường truyền
@endsection

@section('content')

<h3>Chỉnh Sửa Mạng</h3>

<form action="{{ route('mang.update', $mang->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nhahang" class="form-label">Nhà hàng</label>
        <input type="text" class="form-control" id="nhahang" name="nhahang" value="{{ $mang->nhahang }}" required>
    </div>
    <div class="mb-3">
        <label for="nhamang" class="form-label">Nhà mạng</label>
        <input type="text" class="form-control" id="nhamang" name="nhamang" value="{{ $mang->nhamang }}" required>
    </div>
    <div class="mb-3">
        <label for="men" class="form-label">MEN</label>
        <input type="text" class="form-control" id="men" name="men" value="{{ $mang->men }}" required>
    </div>
    <div class="mb-3">
        <label for="account" class="form-label">Account</label>
        <input type="text" class="form-control" id="account" name="account" value="{{ $mang->account }}" required>
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Pass</label>
        <input type="text" class="form-control" id="pass" name="pass" value="{{ $mang->pass }}" required>
    </div>
    <div class="mb-3">
        <label for="diachi" class="form-label">Địa Chỉ</label>
        <input type="text" class="form-control" id="diachi" name="diachi" value="{{ $mang->diachi }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('dsmang') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection