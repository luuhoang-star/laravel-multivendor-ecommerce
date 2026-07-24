@extends('admin.layouts.app')

@section('contents')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Cập nhật vai trò</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.role.index') }}" class="btn btn-primary">Tất cả vai trò</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.role.update', $role) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group mb-3">
                            <label class="form-label required">Tên vai trò</label>
                            <input type="text" class="form-control @error('role') is-invalid @enderror" name="role"
                                value="{{ old('role', $role->name) }}" placeholder="Ví dụ: KYC Manager" required
                                {{ $role->name === \App\Constants\Role::SUPER_ADMIN ? 'readonly' : '' }}>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">

                        <div class="row g-4 mb-4">
                            @foreach ($permissions as $groupName => $permissionGroup)
                                <div class="col-md-6">
                                    <h4 class="text-primary fw-bold mb-3">{{ $groupName ?: 'Các quyền hạn khác' }}</h4>
                                    <div class="d-flex flex-column gap-2">
                                        @foreach ($permissionGroup as $permission)
                                            <label class="form-check mb-2">
                                                <input class="form-check-input" type="checkbox" name="permissions[]"
                                                    value="{{ $permission->name }}"
                                                    {{ in_array($permission->name, old('permissions', $role->permissions->pluck('name')->toArray())) ? 'checked' : '' }}>
                                                <span class="form-check-label">{{ $permission->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Cập nhật vai trò</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
