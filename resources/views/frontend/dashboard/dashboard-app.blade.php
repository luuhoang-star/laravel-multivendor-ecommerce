@extends('frontend.layouts.app')

@section('contents')
    <x-frontend.breadcrumb :items="[['label' => 'Trang chủ', 'url' => '/'], ['label' => 'Thống kê']]" />

    <div class="page-content pt-70 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="dashboard-menu">
                                <ul class="nav flex-column" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab"
                                            href="{{ route('dashboard') }}" role="tab" aria-controls="dashboard"
                                            aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Bảng điều khiển</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href=""
                                            role="tab" aria-controls="orders" aria-selected="false"><i
                                                class="fi-rs-shopping-bag mr-10"></i>Đơn hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders"
                                            role="tab" aria-controls="track-orders" aria-selected="false"><i
                                                class="fi-rs-shopping-cart-check mr-10"></i>Theo dõi đơn hàng</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address"
                                            role="tab" aria-controls="address" aria-selected="true"><i
                                                class="fi-rs-marker mr-10"></i>Địa chỉ của tôi</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('profile') }}">
                                            <i class="fi-rs-user mr-10"></i>
                                            Chi tiết tài khoản
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="wishlist-detail-tab" data-bs-toggle="tab"
                                            href="#wishlist-tab" role="tab" aria-controls="wishlist-tab"
                                            aria-selected="true"><i class="fi-rs-heart mr-10"></i> Danh sách yêu thích</a>
                                    </li>
                                    <li class="nav-item"> {{-- Menu --}}
                                        <a class="nav -link" onclick="event.preventDefault(); $('.form-logout').submit()"
                                            href="login.html"> {{-- Gửi form logout --}}
                                            <i class="fi-rs-sign-out mr-10"></i> {{-- Icon --}}
                                            Đăng xuất
                                        </a>
                                    </li>

                                    <form class="form-logout" action="{{ route('logout') }}" method="POST">
                                        {{-- Form logout --}}
                                        @csrf {{-- CSRF --}}
                                    </form>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content account dashboard-content pl-50">

                                @yield('dashboard_contents')




                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
