@extends('master')

@section('title')
Danh sách đường truyền internet
@endsection

@section('content')


<div class="col-md-12">
    <div class="card">
        <div class="card-header">
                <h4 class="card-title">Danh sách đường truyền - MST: 0107742477</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <a href="{{ route('mangs.export') }}" class="badge badge-black mb-3"><i class="fa icon-cloud-download"></i> Xuất Excel</a>
                <a href="{{ route('mangs.pdf') }}" class="badge badge-warning mb-3"><i class="fa icon-cloud-download"></i> Xuất PDF</a>
                <table id="multi-filter-select"
                        class="table table-bordered table-head-bg-info table-bordered-bd-info mt-4">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nhà hàng</th>
                            <th>Nhà mạng VNPT:{{ $mangs->where('nhamang', 'VNPT 18001166')->where('status', 1)->count() }} VIETTEL:{{ $mangs->where('nhamang', 'VIETTEL 18008119')->where('status', 1)->count() }}</th>
                            <th>MEN <br>
                                Ip tĩnh: {{ $mangs->filter(fn($item) => str_contains(strtolower($item->men), 'iptinh') && $item->status == 1)->count() }}
                            </th>
                            <th>Account</th>
                             @if(Auth::user()->level === 1 || Auth::user()->level === 2) <th>Pass</th> @endif
                            <th>Địa chỉ</th>
                            <th>KT khu vực</th>
                            <th>Trạng thái {{ $mangs->where('status', 1)->count() }}+{{ $mangs->where('status', 0)->count() }}</th>
                            <th><button class="btn btn-warning btn-sm" onclick="window.location.href='{{ route('mang.create') }}'">
                    <span class="btn-label">
                        <i class="fa fa-plus"></i>
                    </span>
                    Thêm mới
                </button></th>
                        </tr>
                    </thead>
                     <tfoot>
                    
                        <tr>
                            <th>ID</th>
                            <th>Nhà hàng</th>
                            <th>Nhà mạng</th>
                            <th>MEN</th>
                            <th>Account</th>
                             @if(Auth::user()->level === 1 || Auth::user()->level === 2)<th>Pass</th> @endif
                            <th>Địa chỉ</th>
                            <th>KT khu vực</th>
                            <th>Trạng thái</th>
                            <th></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($mangs as $mang)
                        <tr>
                            <td>{{ $mang->id }}</td>
                            <td >{{ $mang->nhahang }}</td>
                            <td class="@if ($mang->nhamang == 'VNPT 18001166') bg-info @elseif ($mang->nhamang == 'VIETTEL 18008119') bg-danger @else bg-warning @endif">{{ $mang->nhamang }}</td>
                            <td>{{ $mang->men }}</td>
                            <td>{{ $mang->account }}</td>
                           @if(Auth::user()->level === 1 || Auth::user()->level === 2) 
                                <td>
                                    <span class="password-field" onclick="this.innerText = this.innerText === '••••••••' ? '{{ $mang->pass }}' : '••••••••'" style="cursor: pointer; font-weight: bold;" title="Click để hiện/ẩn mật khẩu">••••••••</span>
                                </td> 
                            @endif
                            <td>{{ $mang->diachi }}</td>
                            <td>{{ $mang->ktkv }}</td>
                            <td class="@if ($mang->status == 1) bg-success @elseif ($mang->status == 2) bg-warning @else bg-danger @endif">
                                 @if ($mang->status == 1)
                                    Hoạt động
                                @elseif ($mang->status == 2)
                                    Sắp hoạt động
                                @else
                                    Không hoạt động 
                                @endif    
                            </td>
                            <td>
                                <div class="form-button-action" style="display: flex; align-items: center;">
                                    <button type="button" class="btn btn-link btn-primary me-2" onclick="window.location='{{ route('mang.edit', $mang->id) }}'" data-original-title="Edit Task">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <form action="{{ route('mang.destroy', $mang->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                            data-bs-toggle="tooltip"
                                            title=""
                                            class="btn btn-link btn-danger"
                                            data-original-title="Remove" onclick="return confirm('Bạn có chắc chắn muốn xóa mạng này?')">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>

@endsection