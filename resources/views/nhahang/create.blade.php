@extends('master')

@section('title')
Thêm Mới Nhà Hàng
@endsection

@section('content')

<h5>Thêm Mới Nhà Hàng</h5>
<form action="{{ route('nhahang.store') }}" method="POST">
    @csrf

<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="vung">Thương hiệu</label>
                            <select class="form-select" id="vung" name="vung" >
                                @foreach($thuonghieu as $thuonghieus)
                                    <option value="{{ $thuonghieus->thuonghieu }}">{{ $thuonghieus->thuonghieu }}</option>
                                @endforeach                              
                            </select>
                    </div>                    
                    <div class="form-group">
                        <label for="nhathau">Nhà Thầu</label>
                            <select class="form-select" id="nhathau" name="nhathau">
                                @foreach($nhathaus as $nhathauss)
                                    <option value="{{ $nhathauss->nhathau }}">{{ $nhathauss->nhathau }}</option>
                                @endforeach                              
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="ruijie">Ruijie</label>
                            <select class="form-select" id="ruijie" name="ruijie">
                                <option value="1">Có</option>
                                <option value="0">Không</option>
                            </select>

                     <!--   <label for="ruijie" class="form-label">Ruijie</label>
                        <input type="text" class="form-control" id="ruijie" name="ruijie" required> -->
                    </div>
                    <div class="form-group">
                        <label for="daucam" class="form-label">Đầu cam</label>
                        <input type="text" class="form-control" id="daucam" name="daucam" required>
                    </div>                    
                </div>


                <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="matcam" class="form-label">Mắt cam</label>
                        <input type="text" class="form-control" id="matcam" name="matcam" required>
                    </div>

                    <div class="form-group">
                        <label for="ten" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="ten" name="ten" required>
                    </div>
                    <div class="form-group">
                        <label for="diachi" class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" id="diachi" name="diachi" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="1">Hoạt động</option>
                                <option value="2">Sắp hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>

                     <!--   <label for="ruijie" class="form-label">Ruijie</label>
                        <input type="text" class="form-control" id="ruijie" name="ruijie" required> -->
                    </div>                   
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="form-group">
                        <label for="sdt" class="form-label">SĐT</label>
                        <input type="text" class="form-control" id="sdt" name="sdt" required>
                    </div>
                    <div class="form-group">
                        <label for="iptinh" class="form-label">Ip tĩnh</label>
                        <input type="text" class="form-control" id="iptinh" name="iptinh" required>
                    </div>
                    <div class="form-group">
                        <label for="ipmc" class="form-label">Ip máy chủ</label>
                        <input type="text" class="form-control" id="ipmc" name="ipmc" required>
                    </div>
                </div>    

            </div>
        </div>
    </div>
</div>
    <button type="submit" class="btn btn-primary">Thêm</button>
    <a href="{{ route('dsnhahang') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection