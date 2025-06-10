@extends('master')

@section('title')
Chỉnh Sửa Tài Khoản Camera
@endsection

@section('content')

<h3>Sửa Tài Khoản Camera</h3>

<form action="{{ route('camera.update', $camera->id) }}" method="POST">
    @csrf
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">  
                <div class="col-md-6 col-lg-4">  
                    <div class="form-group">
                        <label for="nhahang" class="form-label">Nhà Hàng</label>
                        <input type="text" class="form-control" id="nhahang" name="nhahang" value="{{ $camera->nhahang }}" required>
                    </div>
                    <div class="form-group">
                        <label for="domain" class="form-label">Domain</label>
                        <input type="text" class="form-control" id="domain" name="domain" value="{{ $camera->domain }}" required>
                    </div>
                    <div class="form-group">
                        <label for="port" class="form-label">Port</label>
                        <input type="text" class="form-control" id="port" name="port" value="{{ $camera->port }}" required>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">    
                    <div class="form-group">
                        <label for="user" class="form-label">User</label>
                        <input type="text" class="form-control" id="user" name="user" value="{{ $camera->user }}" required>
                    </div>
                    <div class="form-group">
                        <label for="pass" class="form-label">Pass</label>
                        <input type="text" class="form-control" id="pass" name="pass" value="{{ $camera->pass }}" required>
                    </div>
                    <div class="form-group">
                        <label for="passcam" class="form-label">Passcam</label>
                        <input type="text" class="form-control" id="passcam" name="passcam" value="{{ $camera->passcam }}" required>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('dscamera') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection