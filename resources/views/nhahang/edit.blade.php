@extends('master')

@section('title')
Chỉnh Sửa Nhà Hàng
@endsection

@section('content')

<h3>Chỉnh Sửa Nhà Hàng</h3>

<form action="{{ route('nhahang.update', $nhahang->id) }}" method="POST">
    @csrf
<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row">  
                <div class="col-md-6 col-lg-4">  
                    <div class="form-group">
                        <label for="vung">Thương hiệu</label>
                            <select class="form-select" id="vung" name="vung">
                                <option value="{{ $nhahang->vung }}">{{ $nhahang->vung }}</option>
                                @foreach($thuonghieu as $thuonghieus)
                                    <option value="{{ $thuonghieus->thuonghieu }}">{{ $thuonghieus->thuonghieu }}</option>
                                @endforeach                              
                            </select>
                    </div>
                    <div class="form-group">
                        <label for="nhathau">Nhà Thầu</label>
                            <select class="form-select" id="nhathau" name="nhathau">
                                <option value="{{ $nhahang->nhathau }}">{{ $nhahang->nhathau }}</option>
                                @foreach($nhathaus as $nhathauss)
                                    <option value="{{ $nhathauss->nhathau }}">{{ $nhathauss->nhathau }}</option>
                                @endforeach                              
                            </select>
                    </div>
                    <div class="form-group">

                        <label for="ruijie">Ruijie</label>
                        <select class="form-select" id="ruijie" name="ruijie">
                            <option value="{{ $nhahang->ruijie }}" selected>
                                {{ $nhahang->ruijie == 1 ? 'Có' : 'Không' }}
                            </option>
                            <option value="1" {{ $nhahang->ruijie == 1 ? 'selected' : '' }}>Có</option>
                            <option value="0" {{ $nhahang->ruijie == 0 ? 'selected' : '' }}>Không</option>
                        </select>

                        <!-- <label for="ruijie" class="form-label">Ruijie</label>
                        <input type="text" class="form-control" id="ruijie" name="ruijie" value="{{ $nhahang->ruijie }}" required> -->
                    </div>
                    <div class="form-group">
                        <label for="daucam" class="form-label">Đầu cam</label>
                        <input type="text" class="form-control" id="daucam" name="daucam" value="{{ $nhahang->daucam }}" required>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">    
                    <div class="form-group">
                        <label for="matcam" class="form-label">Mắt cam</label>
                        <input type="text" class="form-control" id="matcam" name="matcam" value="{{ $nhahang->matcam }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ten" class="form-label">Tên</label>
                        <input type="text" class="form-control" id="ten" name="ten" value="{{ $nhahang->ten }}" required>
                    </div>
                    <div class="form-group">
                        <label for="diachi" class="form-label">Địa Chỉ</label>
                        <input type="text" class="form-control" id="diachi" name="diachi" value="{{ $nhahang->diachi }}" required>
                    </div>
                     <div class="form-group">
                        <label for="status">Trạng thái</label>
                            <select class="form-select" id="status" name="status">
                                <option value="{{ $nhahang->status }}" selected>
                                    {{ $nhahang->status == 1 ? 'Hoạt động' : 'Không hoạt động' }}
                                </option>
                                <option value="1">Hoạt động</option>
                                <option value="0">Không hoạt động</option>
                            </select>

                     <!--   <label for="ruijie" class="form-label">Ruijie</label>
                        <input type="text" class="form-control" id="ruijie" name="ruijie" required> -->
                    </div>  
                </div>
                <div class="col-md-6 col-lg-4">    
                    <div class="form-group">
                        <label for="sdt" class="form-label">SĐT</label>
                        <input type="text" class="form-control" id="sdt" name="sdt" value="{{ $nhahang->sdt }}" required>
                    </div>
                    <div class="form-group">
                        <label for="iptinh" class="form-label">Ip tĩnh</label>
                        <input type="text" class="form-control" id="iptinh" name="iptinh" value="{{ $nhahang->iptinh }}" required>
                    </div>
                    <div class="form-group">
                        <label for="ipmc" class="form-label">Ip máy chủ</label>
                        <input type="text" class="form-control" id="ipmc" name="ipmc" value="{{ $nhahang->ipmc }}" required>
                    </div>
                </div>    
            </div>
        </div>
    </div>
</div>                
    <button type="submit" class="btn btn-primary">Lưu</button>
    <a href="{{ route('dsnhahang') }}" class="btn btn-secondary">Hủy</a>
</form>

@endsection