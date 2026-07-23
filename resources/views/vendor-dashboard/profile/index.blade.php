@extends('vendor-dashboard.layouts.app')

@section('contents')
    <div class="container-xl">

        {{-- Update Profile --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Cập nhật hồ sơ</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-input-image 
                                imageUploadId="image-upload" 
                                imagePreviewId="image-preview" 
                                imageLabelId="image-label" 
                                name="avatar" 
                                :image="auth('web')->user()->avatar ? asset(auth('web')->user()->avatar) : asset('defaults/avatar.png')" 
                            />
                            <x-input-error :messages="$errors->get('avatar')" />

                            <label class="form-label mt-2">Họ tên</label>
                            <input type="text" class="form-control" name="name"
                                value="{{ auth('web')->user()->name }}">
                            <x-input-error :messages="$errors->get('name')" />
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email"
                                value="{{ auth('web')->user()->email }}">
                            <x-input-error :messages="$errors->get('email')" />
                        </div>
                    </div>

                    <button class="btn btn-primary">
                        Cập nhật tài khoản
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Cập nhật mật khẩu</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('password.update') }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" class="form-control">
                            <x-input-error :messages="$errors->get('current_password')" />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" name="password" class="form-control">
                            <x-input-error :messages="$errors->get('password')" />
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        Cập nhật mật khẩu
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
                label_default: "Chọn ảnh",
                label_selected: "Đổi ảnh",
                no_label: false
            });
        });
    </script>
@endpush
