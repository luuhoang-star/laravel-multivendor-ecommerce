@extends('admin.layouts.app')

@section('contents')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Chi tiết yêu cầu KYC</h3>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-sm">
                        Quay lại
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table table-striped">
                            <tbody>
                                <tr>
                                    <td class="w-25 font-weight-bold">Tên đầy đủ</td>
                                    <td>{{ $kycRequest->full_name }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Email</td>
                                    <td>{{ $kycRequest->user?->email }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Ngày sinh</td>
                                    <td>{{ $kycRequest->date_of_birth }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Giới tính</td>
                                    <td>
                                        @if ($kycRequest->gender == 'male' || $kycRequest->gender == 'Nam')
                                            Nam
                                        @elseif ($kycRequest->gender == 'female' || $kycRequest->gender == 'Nữ')
                                            Nữ
                                        @else
                                            {{ $kycRequest->gender }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Địa chỉ đầy đủ</td>
                                    <td>{{ $kycRequest->address }}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Loại tài liệu</td>
                                    <td>
                                        @if ($kycRequest->document_type == 'passport')
                                            Hộ chiếu (Passport)
                                        @elseif ($kycRequest->document_type == 'driving_license')
                                            Bằng lái xe (Driving License)
                                        @elseif ($kycRequest->document_type == 'id_card')
                                            Căn cước công dân (ID Card)
                                        @else
                                            {{ $kycRequest->document_type }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Tài liệu scan</td>
                                    <td>
                                        <a href="{{ route('admin.kyc.download', $kycRequest) }}"
                                            class="btn btn-primary btn-sm">
                                            Tải xuống tài liệu
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Trạng thái hiện tại</td>
                                    <td>
                                        @if ($kycRequest->status == 'pending')
                                            <span class="badge bg-warning text-warning-fg">Đang chờ duyệt</span>
                                        @elseif ($kycRequest->status == 'approved')
                                            <span class="badge bg-success text-success-fg">Đã duyệt</span>
                                        @else
                                            <span class="badge bg-danger text-danger-fg">Từ chối</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">Thay đổi trạng thái</td>
                                    <td>
                                        <form action="{{ route('admin.kyc.update', $kycRequest) }}" method="POST"
                                            class="d-flex align-items-center gap-2" style="max-width: 400px;">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" class="form-select form-control">
                                                <option value="pending"
                                                    {{ $kycRequest->status == 'pending' ? 'selected' : '' }}>Đang chờ duyệt
                                                </option>
                                                <option value="approved"
                                                    {{ $kycRequest->status == 'approved' ? 'selected' : '' }}>Đã duyệt
                                                </option>
                                                <option value="rejected"
                                                    {{ $kycRequest->status == 'rejected' ? 'selected' : '' }}>Từ chối
                                                    (Rejected)</option>
                                            </select>
                                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
