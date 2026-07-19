 @extends('frontend.dashboard.dashboard-app')

@section('dashboard_contents')
 <div class="tab-pane fade" id="track-orders" role="tabpanel"
                                        aria-labelledby="track-orders-tab">
                                        <div class="card">
                                            <div class="card-header p-0">
                                                <h3 class="mb-0">Theo dõi đơn hàng</h3>
                                            </div>
                                            <div class="card-body p-0 contact-from-area">
                                                <p>Để theo dõi đơn hàng của bạn, vui lòng nhập Mã đơn hàng vào ô bên dưới và nhấn nút "Theo dõi". Mã này đã được cung cấp cho bạn trên biên nhận hoặc trong email xác nhận bạn đã nhận được.</p>
                                                <div class="row">
                                                    <div class="col-lg-8">
                                                        <form class="contact-form-style mt-30 mb-50" action="#"
                                                            method="post">
                                                            <div class="input-style mb-20">
                                                                <label>Mã đơn hàng</label>
                                                                <input name="order-id"
                                                                    placeholder="Tìm thấy trong email xác nhận đơn hàng của bạn"
                                                                    type="text" />
                                                            </div>
                                                            <div class="input-style mb-20">
                                                                <label>Email thanh toán</label>
                                                                <input name="billing-email"
                                                                    placeholder="Email bạn đã sử dụng khi thanh toán"
                                                                    type="email" />
                                                            </div>
                                                            <button class="btn" type="submit">Theo dõi</button>
                                                        </form>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-xl-12">
                                                        <div class="wsus__track_header">
                                                            <div class="wsus__track_header_text">
                                                                <div class="row">
                                                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                                                        <div class="wsus__track_header_single">
                                                                            <h5>Thời gian giao hàng dự kiến:</h5>
                                                                            <p>20 nov 2021</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                                                        <div class="wsus__track_header_single">
                                                                            <h5>Mua sắm bởi:</h5>
                                                                            <p>one shop</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                                                        <div class="wsus__track_header_single">
                                                                            <h5>Trạng thái:</h5>
                                                                            <p>Đang xử lý đơn hàng</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xl-3 col-sm-6 col-lg-3">
                                                                        <div class="wsus__track_header_single">
                                                                            <h5>Mã vận đơn:</h5>
                                                                            <p>BD096547155HGU</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-12">
                                                        <ul class="pro_trckr">
                                                            <li class="check_mark">Đơn hàng đang chờ</li>
                                                            <li class="">Đang xử lý đơn hàng</li>
                                                            <li class="">Đang giao hàng</li>
                                                            <li class="red_mark">Sẵn sàng giao hàng</li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="col-12">
                                                            <div class="track_pro_table">
                                                                <div class="table-responsive">
                                                                    <table class="table m-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="img">Sản phẩm</th>
                                                                                <th class="description"></th>
                                                                                <th class="price">Giá</th>
                                                                                <th class="discount">Số lượng</th>
                                                                                <th class="total">Tổng tiền</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            <tr>
                                                                                <td class="img"><a href="#"><img
                                                                                            class="img"
                                                                                            src="assets/imgs/shop/thumbnail-1.jpg"
                                                                                            alt=""></a></td>
                                                                                <td class="description">
                                                                                    <h3><a href="#">NFTMAX- NFT React
                                                                                            Admin & Dashboard
                                                                                            Template</a></h3>
                                                                                    <p>Sản phẩm của WSUS</p>
                                                                                </td>
                                                                                <td class="price">
                                                                                    <p>$30.00</p>
                                                                                </td>
                                                                                <td class="discount">
                                                                                    <p>02</p>
                                                                                </td>
                                                                                <td class="total">
                                                                                    <p>$30.00</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="img"><a href="#"><img
                                                                                            class="img"
                                                                                            src="assets/imgs/shop/thumbnail-2.jpg"
                                                                                            alt=""></a></td>
                                                                                <td class="description">
                                                                                    <h3><a href="#">Oifolio - Digital
                                                                                            Marketing Agency Theme</a>
                                                                                    </h3>
                                                                                    <p>Sản phẩm của WSUS</p>
                                                                                </td>
                                                                                <td class="price">
                                                                                    <p>$40.00</p>
                                                                                </td>
                                                                                <td class="discount">
                                                                                    <p>03</p>
                                                                                </td>
                                                                                <td class="total">
                                                                                    <p>$28.93</p>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td class="img"><a href="#"><img
                                                                                            class="img"
                                                                                            src="assets/imgs/shop/thumbnail-3.jpg"
                                                                                            alt=""></a></td>
                                                                                <td class="description">
                                                                                    <h3><a href="#">Binduz - WordPress
                                                                                            Newspaper News and
                                                                                            Magazine</a></h3>
                                                                                    <p>Sản phẩm của WSUS</p>
                                                                                </td>
                                                                                <td class="price">
                                                                                    <p>$99.00</p>
                                                                                </td>
                                                                                <td class="discount">
                                                                                    <p>05</p>
                                                                                </td>
                                                                                <td class="total">
                                                                                    <p>$28.93</p>
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
@endsection
