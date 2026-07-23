@extends('vendor-dashboard.layouts.app')

@section('contents')
    <div class="page-body">
        <div class="container-xl">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Hồ sơ cửa hàng</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('vendor.store-profile.update', $store->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- Logo --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Logo cửa hàng</label>
                                <x-input-image imageUploadId="image-upload" imagePreviewId="image-preview"
                                    imageLabelId="image-label" name="logo" :image="$store?->logo ? asset($store->logo) : asset('defaults/shop.png')" />
                                <x-input-error :messages="$errors->get('logo')" />
                            </div>

                            {{-- Banner --}}
                            <div class="col-md-6 mb-4">
                                <label class="form-label">Banner cửa hàng</label>
                                <x-input-image imageUploadId="image-upload-two" imagePreviewId="image-preview-two"
                                    imageLabelId="image-label-two" name="banner" :image="$store?->banner ? asset($store->banner) : asset('defaults/banner.png')"
                                    class="banner-preview" />
                                <x-input-error :messages="$errors->get('banner')" />
                            </div>
                        </div>

                        <div class="row">
                            {{-- Tên cửa hàng --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tên cửa hàng <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name', $store?->name) }}" placeholder="Nhập tên cửa hàng">
                                <x-input-error :messages="$errors->get('name')" />
                            </div>

                            {{-- Điện thoại --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Số điện thoại</label>
                                <input type="text" class="form-control" name="phone"
                                    value="{{ old('phone', $store?->phone) }}" placeholder="Nhập số điện thoại">
                                <x-input-error :messages="$errors->get('phone')" />
                            </div>
                        </div>

                        <div class="row">
                            {{-- Email --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Email cửa hàng</label>
                                <input type="email" class="form-control" name="email"
                                    value="{{ old('email', $store?->email) }}" placeholder="Nhập email cửa hàng">
                                <x-input-error :messages="$errors->get('email')" />
                            </div>
                        </div>

                        <div class="row">
                            {{-- Địa chỉ --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Địa chỉ</label>
                                <input type="text" class="form-control" name="address"
                                    value="{{ old('address', $store?->address) }}" placeholder="Nhập địa chỉ cửa hàng">
                                <x-input-error :messages="$errors->get('address')" />
                            </div>
                        </div>

                        <div class="row">
                            {{-- Mô tả ngắn --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mô tả ngắn <span class="text-danger">*</span></label>
                                <textarea class="form-control" name="short_description" rows="3" placeholder="Nhập mô tả ngắn về cửa hàng">{{ old('short_description', $store?->short_description) }}</textarea>
                                <x-input-error :messages="$errors->get('short_description')" />
                            </div>
                        </div>

                        <div class="row">
                            {{-- Mô tả chi tiết --}}
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Mô tả chi tiết</label>
                                <textarea class="form-control" name="long_description" id="editor" rows="6"
                                    placeholder="Nhập mô tả chi tiết về cửa hàng">{!! old('long_description', $store?->long_description) !!}</textarea>
                                <x-input-error :messages="$errors->get('long_description')" />
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Cập nhật cửa hàng
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
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
                label_default: "Chọn ảnh",
                label_selected: "Đổi ảnh",
                no_label: false
            });
            $.uploadPreview({
                input_field: "#image-upload-two",
                preview_box: "#image-preview-two",
                label_field: "#image-label-two",
                label_default: "Chọn ảnh",
                label_selected: "Đổi ảnh",
                no_label: false
            });
        });
    </script>
@endpush
