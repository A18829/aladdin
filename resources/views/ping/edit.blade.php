@extends('master')

@section('title')
Chỉnh Sửa IP
@endsection

@section('content')

<h3>Chỉnh Sửa Nhà Hàng</h3>

<form action="{{ route('ping.update', $pings->id) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nhahang" class="form-label">Nhà hàng</label>
        <input type="text" class="form-control" id="nhahang" name="nhahang" value="{{ $pings->nhahang }}" required>
    </div>
    <div class="mb-3">
        <label for="iptinh" class="form-label">IP</label>
        <input type="text" class="form-control" id="iptinh" name="iptinh" value="{{ $pings->iptinh }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('ping') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection