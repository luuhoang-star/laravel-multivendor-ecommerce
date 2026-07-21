@extends('admin.layouts.app')

@section('contents')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Yêu cầu KYC đang chờ duyệt</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Tên Vendor</th>
                                    <th>Email</th>
                                    <th>Ngày sinh</th>
                                    <th>Giới tính</th>
                                    <th>Trạng thái</th>
                                    <th class="w-1">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($kycRequests as $kycRequest)
                                    <tr>
                                        <td>{{ ($kycRequests->currentPage() - 1) * $kycRequests->perPage() + $loop->iteration }}</td>
                                        <td>{{ $kycRequest->full_name }}</td>
                                        <td class="text-secondary">{{ $kycRequest->user?->email }}</td>
                                        <td class="text-secondary">{{ $kycRequest->date_of_birth }}</td>
                                        <td class="text-secondary">
                                            @if ($kycRequest->gender == 'male' || $kycRequest->gender == 'Nam')
                                                Nam
                                            @elseif ($kycRequest->gender == 'female' || $kycRequest->gender == 'Nữ')
                                                Nữ
                                            @else
                                                {{ $kycRequest->gender }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($kycRequest->status == 'pending')
                                                <span class="badge bg-warning text-warning-fg">Đang chờ duyệt</span>
                                            @elseif ($kycRequest->status == 'approved')
                                                <span class="badge bg-success text-success-fg">Đã duyệt</span>
                                            @else
                                                <span class="badge bg-danger text-danger-fg">Từ chối</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.kyc.show', $kycRequest) }}" class="btn btn-primary btn-sm">Xem chi tiết</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-secondary">Không có yêu cầu KYC nào đang chờ duyệt.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @if ($kycRequests->hasPages())
                    <div class="card-footer d-flex align-items-center justify-content-between">
                        <p class="m-0 text-secondary">
                            Hiển thị từ <strong>{{ $kycRequests->firstItem() }}</strong> đến <strong>{{ $kycRequests->lastItem() }}</strong> trong tổng số <strong>{{ $kycRequests->total() }}</strong> kết quả
                        </p>
                        <div class="ms-auto">
                            {{ $kycRequests->links() }}
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
