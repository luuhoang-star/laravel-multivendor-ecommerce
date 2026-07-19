@extends('frontend.dashboard.dashboard-app')

@section('dashboard_contents')

<div class="tab-pane fade active show" id="dashboard" role="tabpanel"
                                        aria-labelledby="dashboard-tab">
                                        <div class="card">
                                            <div class="card-header p-0 pb-10">
                                                <h3 class="mb-0">Xin chào Rosie!</h3>
                                            </div>
                                            <div class="card-body p-0">
                                                <p>
                                                    Từ bảng điều khiển tài khoản của bạn, bạn có thể dễ dàng kiểm tra &amp; xem các <a
                                                        href="#">đơn hàng gần đây</a>,<br />
                                                    quản lý <a href="#">địa chỉ giao hàng và thanh toán</a> cũng như <a
                                                        href="#">chỉnh sửa mật khẩu và chi tiết tài khoản.</a>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="dashboard_card blue">
                                                    <span><i class="fa-solid fa-cart-shopping"></i></span>
                                                    <h3>27</h3>
                                                    <p>Tổng đơn hàng</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="dashboard_card red">
                                                    <span><i class="fa-solid fa-xmark"></i></span>
                                                    <h3>24</h3>
                                                    <p>Đơn hàng đã hủy</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="dashboard_card orange">
                                                    <span><i class="fa-solid fa-spinner"></i></span>
                                                    <h3>30</h3>
                                                    <p>Đơn hàng đang chờ</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="dashboard_card green">
                                                    <span><i class="fi-rs-shopping-bag"></i></span>
                                                    <h3>30</h3>
                                                    <p>Tổng đơn hàng</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="dashboard_card pink">
                                                    <span><i class="fi-rs-shopping-bag"></i></span>
                                                    <h3>30</h3>
                                                    <p>Tổng đơn hàng</p>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="dashboard_card purple">
                                                    <span><i class="fi-rs-shopping-bag"></i></span>
                                                    <h3>30</h3>
                                                    <p>Tổng đơn hàng</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

@endsection
