@extends('frontend.layouts.app')

@section('contents')
    <div class="container my-5">

        <div class="row">

            <div class="col-lg-6 offset-lg-3">

                <div class="card">

                    <div class="card-header">
                        <h4>Xác minh danh tính (KYC)</h4>
                    </div>

                    <div class="card-body">

                        <form action="{{ route('kyc.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- Full Name --}}
                            <div class="mb-3">
                                <label class="fw-bold">
                                    Họ và tên
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control" name="full_name">
                            </div>

                            {{-- Date Of Birth --}}
                            <div class="mb-3">
                                <label class="fw-bold">
                                    Ngày sinh
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control datepicker" name="date_of_birth" placeholder="YYYY-MM-DD" autocomplete="off">
                            </div>

                            {{-- Gender --}}
                            <div class="mb-3">

                                <label class="fw-bold">
                                    Giới tính
                                    <span class="text-danger">*</span>
                                </label>

                                <select class="form-control" name="gender">

                                    <option value="">
                                        Chọn
                                    </option>

                                    <option value="male">
                                        Nam
                                    </option>

                                    <option value="female">
                                        Nữ
                                    </option>

                                </select>

                            </div>

                            {{-- Address --}}
                            <div class="mb-3">

                                <label class="fw-bold">
                                    Địa chỉ đầy đủ
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="text" class="form-control" name="address">

                            </div>

                            {{-- Document Type --}}
                            <div class="mb-3">

                                <label class="fw-bold">
                                    Loại giấy tờ
                                    <span class="text-danger">*</span>
                                </label>

                                <select class="form-control" name="document_type">

                                    <option value="">
                                        Chọn
                                    </option>

                                    <option value="id_card">
                                        Căn cước công dân
                                    </option>

                                    <option value="passport">
                                        Hộ chiếu
                                    </option>

                                    <option value="driving_license">
                                        Bằng lái xe
                                    </option>

                                </select>

                            </div>

                            {{-- Document --}}
                            <div class="mb-3">

                                <label class="fw-bold">
                                    Ảnh chụp/Bản scan giấy tờ
                                    <span class="text-danger">*</span>
                                </label>

                                <input type="file" class="form-control" name="document_scan_copy">

                            </div>

                            <button class="btn btn-primary w-100" type="submit">

                                Gửi yêu cầu

                            </button>



                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
