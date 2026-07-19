 @extends('frontend.dashboard.dashboard-app')

@section('dashboard_contents')
 <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                        <div class="card">
                                            <div class="card-header p-0">
                                                <h3 class="mb-0">Đơn hàng của bạn</h3>
                                            </div>
                                            <div class="card-body p-0">
                                                <div class="table-responsive">
                                                    <table class="order_table table m-0 mt-20">
                                                        <thead>
                                                            <tr>
                                                                <th>Đơn hàng</th>
                                                                <th>Ngày mua</th>
                                                                <th>Trạng thái</th>
                                                                <th>Tổng cộng</th>
                                                                <th>Thao tác</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>#1357</td>
                                                                <td>March 45, 2020</td>
                                                                <td><span class="text-warning">Chờ xử lý</span></td>
                                                                <td>$125.00 cho 2 sản phẩm</td>
                                                                <td><a href="dashboard_order_details.html"
                                                                        class="btn-small d-block">Chi tiết</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2468</td>
                                                                <td>June 29, 2020</td>
                                                                <td><span class="text-danger">Đã hủy</span></td>
                                                                <td>$364.00 cho 5 sản phẩm</td>
                                                                <td><a href="dashboard_order_details.html"
                                                                        class="btn-small d-block">Chi tiết</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#2366</td>
                                                                <td>August 02, 2020</td>
                                                                <td><span class="text-primary">Hoàn thành</span></td>
                                                                <td>$280.00 cho 3 sản phẩm</td>
                                                                <td><a href="dashboard_order_details.html"
                                                                        class="btn-small d-block">Chi tiết</a></td>
                                                            </tr>
                                                            <tr>
                                                                <td>#1357</td>
                                                                <td>March 45, 2020</td>
                                                                <td><span class="text-warning">Đang xử lý</span></td>
                                                                <td>$125.00 cho 2 sản phẩm</td>
                                                                <td><a href="dashboard_order_details.html"
                                                                        class="btn-small d-block">Chi tiết</a></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
@endsection
