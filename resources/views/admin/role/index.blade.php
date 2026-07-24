@extends('admin.layouts.app')

@section('contents')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Tất cả vai trò</h3>
                    <div class="card-actions">
                        <a href="{{ route('admin.role.create') }}" class="btn btn-primary">Tạo vai trò mới</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>TÊN VAI TRÒ</th>
                                    <th>SỐ QUYỀN HẠN</th>
                                    <th>SỐ TÀI KHOẢN</th>
                                    <th class="w-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $role->name }}</td>
                                        <td>
                                            <span class="badge bg-primary-lt">{{ $role->permissions_count }} quyền</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-green-lt">{{ $role->users_count }} tài khoản</span>
                                        </td>
                                        <td class="text-end">
                                            @if ($role->name !== \App\Constants\Role::SUPER_ADMIN)
                                                <div>
                                                    <a href="{{ route('admin.role.edit', $role) }}" class="text-primary text-decoration-none">Sửa</a>
                                                </div>
                                                <div>
                                                    <a href="{{ route('admin.role.destroy', $role) }}" class="text-danger delete-item text-decoration-none">Xóa</a>
                                                </div>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center text-secondary py-4">Chưa có vai trò nào được tạo.</td>
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
