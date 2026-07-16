
@extends('frontend.layouts.app')

@section('contents')
 <x-frontend.breadcrumb :items="[['label' => 'Trang chủ', 'url' => '/'], ['label' => 'Quên mật khẩu']]" /> <!--Truyền dữ liệu và lấy dữ liệu từ breadcrum.blade để hiển thị -->
    <div class="page-content pt-150 pb-135">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                    <div class="row">

                        <div class="col-lg-6 col-md-8 offset-lg-3">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <div class="login_wrap widget-taber-content background-white">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h4 class="mb-5">Đặt lại mật khẩu</h4>
                                    </div>
                                    <form method="post" action="{{ route('password.store') }}">
                                        @csrf
                                          <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                        <div class="form-group">
                                            <input type="email" required="" name="email" placeholder="Email*"
                                                value="{{ old('email', $request->email) }}" />
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <input type="password" required="" name="password" placeholder="Password*">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>

                                        <div class="form-group">
                                            <input type="password" required="" name="password_confirmation" placeholder="Xác nhận mật khẩu*">
                                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-heading btn-block hover-up"
                                                name="login">{{ __('Đặt lại mật khẩu') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
