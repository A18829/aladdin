@extends('master')

@section('title')
Thêm Mới Camera
@endsection

@section('content')

<h5>Thêm Mới Tài Khoản Camera</h5>
<form action="{{ route('camera.store') }}" method="POST">
    @csrf

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="nhahang" class="form-label">Nhà Hàng</label>
                        <input type="text" class="form-control" id="nhahang" name="nhahang" required>
                    </div>
                    <div class="form-group">
                        <label for="domain" class="form-label">Domain</label>
                        <input type="text" class="form-control" id="domain" name="domain" required>
                    </div>
                    <div class="form-group">
                        <label for="port" class="form-label">SVR Port</label>
                        <input type="number" class="form-control" id="port" name="port" required>
                    </div>
                    <div class="form-group">
                        <label for="httpport" class="form-label">Http Port</label>
                        <input type="number" class="form-control" id="httpport" name="httpport" required>
                    </div>
                     <div class="form-group">
                        <label for="rtspport" class="form-label">Rtsp Port</label>
                        <input type="number" class="form-control" id="rtspport" name="rtspport" required>
                    </div>                        
                </div>
                <div class="col-md-6 col-lg-4">
                    
                    <div class="form-group">
                        <label for="user" class="form-label">User</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="form-group">
                        <label for="pass" class="form-label">Pass</label>
                        <input type="text" class="form-control" id="pass" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="passcam" class="form-label">Passcam</label>
                        <input type="text" class="form-control" id="passcam" name="passcam" required>
                    </div> 
                     <div class="form-group">
                        <label for="iptinh" class="form-label">Ip tĩnh</label>
                        <input type="text" class="form-control" id="iptinh" name="iptinh" required>
                    </div>                   
                </div>

            </div>
        </div>
    </div>
</div>
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="{{ route('dscamera') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection