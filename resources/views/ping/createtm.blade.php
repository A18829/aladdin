@extends('master')

@section('title')
Thêm Mới Nhà Hàng
@endsection

@section('content')

<h5>Thêm Mới Tên Miền</h5>
<form action="{{ route('ping.storetm') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nhahang" class="form-label">Nhà Hàng</label>
        <input type="text" class="form-control" id="nhahang" name="nhahang" required>
    </div>
    <div class="mb-3">
        <label for="tenmien" class="form-label">Tên Miền</label>
        <input type="text" class="form-control" id="tenmien" name="tenmien" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="{{ route('ping') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection