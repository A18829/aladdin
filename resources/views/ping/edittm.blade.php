@extends('master')

@section('title')
Chỉnh Sửa Nhà Hàng
@endsection

@section('content')

<h3>Chỉnh Sửa Tên Miền</h3>

<form action="{{ route('ping.updatetm', $tenmien->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nhahang" class="form-label">Nhà hàng</label>
        <input type="text" class="form-control" id="nhahang" name="nhahang" value="{{ $tenmien->nhahang }}" required>
    </div>
    <div class="mb-3">
        <label for="tenmien" class="form-label">Tên miền</label>
        <input type="text" class="form-control" id="tenmien" name="tenmien" value="{{ $tenmien->tenmien }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('ping') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection