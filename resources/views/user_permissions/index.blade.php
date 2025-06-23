@extends('master')

@section('content')

<div class="col-md-12">
    <h1>Phân quyền người dùng</h1>

    @foreach($users as $user)
        <div class="card">
            <div class="card-header">
                <h5>{{ $user->name }}</h5>
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
                                            {{ $user->permissions()->where('route_name', $permission->route_name)->exists() ? 'checked' : '' }}>
                                        <label class="form-check-label">{{ $permission->route_name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

@endsection
