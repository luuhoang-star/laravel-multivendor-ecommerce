@extends('admin.layouts.app')

@section('contents')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Tạo tài khoản Admin</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.role-user.index') }}" class="btn btn-primary">Tất cả tài khoản</a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.role-user.store') }}" method="POST">
                        @csrf

                        <div class="form-group mb-3">
                            <label class="form-label required">Tên</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name') }}" placeholder="Ví dụ: Manager" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}" placeholder="Ví dụ: manager@gmail.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required">Mật khẩu</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Nhập mật khẩu (tối thiểu 8 ký tự)" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" name="password_confirmation"
                                placeholder="Nhập lại mật khẩu" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label required">Vai trò</label>
                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>
                                <option value="">-- Chọn vai trò --</option>
                                @foreach ($roles as $role)
                                    @if ($role->name === \App\Constants\Role::SUPER_ADMIN)
                                        @continue
                                    @endif
                                    <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                                        {{ $role->name }}
                                    </option>
                                @endforeach

                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Tạo tài khoản</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
