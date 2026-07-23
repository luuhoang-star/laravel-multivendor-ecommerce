@extends('admin.layouts.app')

@section('contents')
    <div class="container-xl">

        {{-- Update Profile --}}
        <div class="card mb-4">
            <div class="card-header">
                <h3 class="card-title">Cập nhật hồ sơ</h3>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">

                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <x-input-image 
                                imageUploadId="image-upload" 
                                imagePreviewId="image-preview" 
                                imageLabelId="image-label" 
                                name="avatar" 
                                :image="auth('admin')->user()->avatar ? asset(auth('admin')->user()->avatar) : asset('defaults/avatar.png')" 
                            />
                            <x-input-error :messages="$errors->get('avatar')" />

                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label">Email</label>

                            <input type="email" class="form-control" name="email"
                                value="{{ auth('admin')->user()->email }}">
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
                <form action="{{ route('admin.profile.password.update') }}" method="POST">
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



    </div>
@endsection
@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $.uploadPreview({
                input_field: "#image-upload", // Default: .image-upload
                preview_box: "#image-preview", // Default: .image-preview
                label_field: "#image-label", // Default: .image-label
                label_default: "Chọn ảnh", // Default: Choose File
                label_selected: "Đổi ảnh", // Default: Change File
                no_label: false // Default: false
            });
        });
    </script>
@endpush
