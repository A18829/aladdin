@extends('master')

@section('title')
Thêm Mới IP
@endsection

@section('content')

<h5>Thêm Mới Nhà Hàng</h5>
<form action="{{ route('ping.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nhahang" class="form-label">Nhà Hàng</label>
        <input type="text" class="form-control" id="nhahang" name="nhahang" required>
    </div>
    <div class="mb-3">
        <label for="iptinh" class="form-label">Ip tĩnh</label>
        <input type="text" class="form-control" id="iptinh" name="iptinh" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="{{ route('ping') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection