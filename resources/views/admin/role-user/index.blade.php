@extends('admin.layouts.app')

@section('contents')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Tất cả tài khoản Admin</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.role-user.create') }}" class="btn btn-primary">Tạo tài khoản mới</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>TÊN ADMIN</th>
                                    <th>EMAIL</th>
                                    <th>VAI TRÒ</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($admins as $admin)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $admin->name }}</td>
                                        <td>{{ $admin->email }}</td>
                                        <td>
                                            @foreach ($admin->getRoleNames() as $role)
                                                <span class="badge bg-blue-lt me-1">{{ $role }}</span>
                                            @endforeach
                                        </td>
                                        <td class="text-end">
                                            @if (!$admin->hasRole(\App\Constants\Role::SUPER_ADMIN) && $admin->email !== \App\Constants\Role::SUPER_ADMIN_EMAIL)
                                                <div>
                                                    <a href="{{ route('admin.role-user.edit', $admin) }}" class="text-primary text-decoration-none">Sửa</a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.role-user.destroy', $admin) }}" class="text-danger delete-item text-decoration-none">Xóa</a>
                                                </div>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary py-4">Chưa có tài khoản Admin nào được tạo.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
