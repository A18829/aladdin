@extends('master')

@section('content')

<div class="col-md-12">
    <h3>Phân quyền người dùng</h3>

    @foreach($users as $user)
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $user->name }} -- {{ $user->email }}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('user.permissions.update', $user->id) }}" method="POST">
                    @csrf

                    @php
                        $chunks = $permissions->chunk(10);
                    @endphp

                    <div class="form-group d-flex flex-wrap">
                        @foreach($chunks as $chunk)
                            <div class="me-4 mb-3" style="min-width: 200px;">
                                @foreach($chunk as $permission)
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->route_name }}"
                                            {{ $user->permissions()->where('route_name', $permission->route_name)->exists() ? 'checked' : '' }}
                                            @if(Auth::user()->level !== 1 && $user->level === 1) disabled @endif>
                                        <label class="form-check-label">{{ $permission->route_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    
                    <button type="submit" class="btn btn-primary" 
                        @if(Auth::user()->level !== 1 && $user->level === 1) disabled @endif>Cập nhật</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection