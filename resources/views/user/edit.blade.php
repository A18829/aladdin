@extends('master')

@section('title')
Chỉnh Sửa Người Dùng
@endsection

@section('content')

<h3>Chỉnh Sửa Người dùng</h3>

<form action="{{ route('user.update', $userr->id) }}" method="POST">
    @csrf
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">  
                <div class="col-md-6 col-lg-4">  
                    <div class="form-group">
                        <label for="name" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $userr->name }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Username/Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $userr->email }}" required>
                    </div>
                     <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{ $userr->password }}" required>
                    </div>
                    <div class="form-group">
                        <label for="level">Level</label>
                        <select class="form-select" id="level" name="level">
                            <option value="{{ $userr->level }}" selected>
                                {{ $userr->level == 1 ? 'Admin' : ($userr->level == 2 ? 'Sub admin' : 'User') }}
                            </option>
                            <option value="1" {{ $userr->level == 1 ? 'selected' : '' }}>Admin</option>
                            <option value="2" {{ $userr->level == 2 ? 'selected' : '' }}>Sub admin</option>
                            <option value="3" {{ $userr->level == 3 ? 'selected' : '' }}>User</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status">Status</label>
                        <select class="form-select" id="status" name="status">
                            <option value="{{ $userr->status }}" selected>
                                {{ $userr->status == 1 ? 'Active' : 'Deactive' }}
                            </option>
                            <option value="1" {{ $userr->status == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ $userr->status == 0 ? 'selected' : '' }}>Deactive</option>
                        </select>
                    </div>
                
                </div>    
            </div>
        </div>
    </div>
</div>                
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('dsuser') }}" class="btn btn-secondary">Hủy</a>
</form>


@endsection