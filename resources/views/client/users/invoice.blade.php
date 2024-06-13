@extends('client.layouts.master')

@section('content')
    @php
        if($detailOrderUser->status_order === \App\Models\Orders::STATUS_ORDER_PENDING) $status_order = 'Chờ xác nhận';
        if($detailOrderUser->status_order === \App\Models\Orders::STATUS_ORDER_CONFIRMED) $status_order = 'Đã xác nhận';
        if($detailOrderUser->status_order === \App\Models\Orders::STATUS_ORDER_PREPARING_GOODS) $status_order = 'Đang chuẩn bị hàng';
        if($detailOrderUser->status_order === \App\Models\Orders::STATUS_ORDER_SHIPPING) $status_order = 'Đang vận chuyển';
        if($detailOrderUser->status_order === \App\Models\Orders::STATUS_ORDER_DELIVERED) $status_order = 'Đã giao hàng';
        if($detailOrderUser->status_order === \App\Models\Orders::STATUS_ORDER_CANCELED) $status_order = 'Đơn hàng đã bị hủy';

        if($detailOrderUser->status_payment === \App\Models\Orders::STATUS_PAYMENT_UNPAID) $status_payment = 'Chưa thanh toán';
        if($detailOrderUser->status_payment === \App\Models\Orders::STATUS_PAYMENT_PAID) $status_payment = 'Đã thanh toán';

        if($detailOrderUser->payment === 'online') $payment = 'Thanh Toán Online';
        if($detailOrderUser->payment === 'delivery') $payment = 'Thanh Toán Khi Nhận Hàng';

        if($detailOrderUser->voucher){
             if ($detailOrderUser->voucher->type === \App\Models\Voucher::TYPE_FIXED){
                  $discountAfter =  $detailOrderUser->voucher->discount;
                  $totalPriceBefore = $detailOrderUser->total_price + $discountAfter;
             }else if($detailOrderUser->voucher->type === \App\Models\Voucher::TYPE_PERCENTAGE){
                 $totalPriceBefore = $detailOrderUser->total_price / (100/100 - $detailOrderUser->voucher->discount/100) ;
                 $discountAfter = $totalPriceBefore - $detailOrderUser->total_price;
             }
              $discount = $discountAfter < $detailOrderUser->voucher->total ? $discountAfter :  $detailOrderUser->voucher->total;
        }else{
            $discount = 0;
            $totalPriceBefore = $detailOrderUser->total_price;
        }

    @endphp
    <div class="row justify-content-center " style="margin-top: 90px">

        <div class="col-xxl-9">


            <div class="card" id="demo">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed p-4">

                            <div class="d-flex">

                                <div class="flex-grow-1">
                                    <div class="mt-2 mb-2">
                                        <a class="btn btn-primary" href="{{route('client.order')}}">Quay về trang trước</a>
                                    </div>
                                    <img src="{{asset('gallerys/logo_web/logo_ca_nhan.png')}}"
                                         class="card-logo card-logo-dark"
                                         alt="logo dark" height="100">
                                    <img src="{{asset('gallerys/logo_web/logo_ca_nhan2.png')}}"
                                         class="card-logo card-logo-light"
                                         alt="logo light" height="17">
                                    <div class="mt-sm-5 mt-4">
                                        <h6 class="text-muted text-uppercase fw-semibold">Địa Chỉ</h6>
                                        <p class="text-muted mb-1" id="address-details">Quốc Oai, Hà Nội</p>
                                        <p class="text-muted mb-0" id="zip-code"><span>Zip-code:</span> 100</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                    <h6><span class="text-muted fw-normal">Legal Registration No:</span><span
                                            id="legal-register-no">987654</span></h6>
                                    <h6><span class="text-muted fw-normal">Email:</span><span id="email">vinhpqph37185@fpt.edu.vn</span>
                                    </h6>
                                    <h6><span class="text-muted fw-normal">Website:</span> <a
                                            href="https://themesbrand.com/" class="link-primary" target="_blank"
                                            id="website">www.themesbrand.com</a></h6>
                                    <h6 class="mb-0"><span class="text-muted fw-normal">Contact No: </span><span
                                            id="contact-no"> +(84) 108 5402</span></h6>
                                </div>
                            </div>
                        </div>
                        <!--end card-header-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Mã Hóa Đơn</p>
                                    <h5 class="fs-14 mb-0">#VL<span id="invoice-no">25000355</span></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Ngày Đặt</p>
                                    <h5 class="fs-14 mb-0"><span id="invoice-date">23 Nov, 2021</span>
                                        <small class="text-muted" id="invoice-time">02:36PM</small></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Trạng Thái Đơn Hàng</p>
                                    <span class="badge bg-success-subtle text-success fs-11"
                                          id="payment-status">{{$status_order}}</span>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Tổng Tiền</p>
                                    <h5 class="fs-14 mb-0">{{number_format($detailOrderUser->total_price)}}đ</h5>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4 border-top border-top-dashed">
                            <div class="row g-3">
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Người Đặt Hàng</h6>
                                    <p class="fw-medium mb-2" id="billing-name">Phí Quang Vinh</p>
                                    <p class="text-muted mb-1" id="billing-address-line-1">Quoc Oai, Ha Noi</p>
                                    <p class="text-muted mb-1"><span>Phone: +</span><span id="billing-phone-no">(84) 108-5402</span>
                                    </p>
                                    <p class="text-muted mb-0"><span>Tax: </span>
                                        <span id="billing-tax-no">12-3456789</span>
                                    </p>
                                </div>
                                <!--end col-->
                                <div class="col-6">
                                    <h6 class="text-muted text-uppercase fw-semibold mb-3">Người Nhận Hàng</h6>
                                    <p class="fw-medium mb-2" id="shipping-name">{{$detailOrderUser->user_name}}</p>
                                    <p class="text-muted mb-1"
                                       id="shipping-address-line-1">{{$detailOrderUser->user_address}}</p>
                                    <p class="text-muted mb-1"><span>Phone: +</span><span
                                            id="shipping-phone-no">{{$detailOrderUser->user_phone}}</span>
                                    <p class="text-muted mb-1"><span>Email: </span><span
                                            id="shipping-phone-no">{{$detailOrderUser->user_email}}</span>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-borderless text-center table-nowrap align-middle mb-0">
                                    <thead>
                                    <tr class="table-active">
                                        <th scope="col">Thông Tin Đơn Hàng</th>
                                        <th scope="col">Giá Tiền</th>
                                        <th scope="col">Số Lượng</th>
                                        <th scope="col" class="text-end">Tổng Cộng</th>
                                    </tr>
                                    </thead>
                                    <tbody id="products-list">
                                    @foreach($detailOrderUser->orderItems as $product)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                                        <img
                                                            src="{{Storage::url($product->productVariant->product->img_thumbnail)}}"
                                                            alt=""
                                                            class="img-fluid d-block">
                                                    </div>
                                                    <div class="flex-grow-1 ms-3">
                                                        <h5 class="fs-15">
                                                            <a href="apps-ecommerce-product-details.html"
                                                               class="link-primary">{{$product->productVariant->product->name}}</a>
                                                        </h5>
                                                        <p class="text-muted mb-0">Color: <span
                                                                class="fw-medium">{{$product->productVariant->product_color->name}}</span>
                                                        </p>
                                                        <p class="text-muted mb-0">Size: <span
                                                                class="fw-medium">{{$product->productVariant->product_size->name}}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>{{number_format($product->productVariant->price)}}đ</td>
                                            <td class="text-center">0{{$product->quantity}}</td>
                                            <td class="fw-medium text-end">
                                                {{number_format($product->productVariant->price*$product->quantity)}}đ
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table><!--end table-->
                            </div>
                            <div class="border-top border-top-dashed mt-2">
                                <table class="table table-borderless table-nowrap align-middle mb-0 ms-auto"
                                       style="width:250px">
                                    <tbody>
                                    <tr>
                                        <td>Tổng</td>
                                        <td class="text-end">{{number_format($totalPriceBefore)}}đ</td>
                                    </tr>
                                    <tr>
                                        <td>Mã Giảm <small class="text-muted">
                                                @if($detailOrderUser->voucher)
                                                    ({{$detailOrderUser->voucher->code}})
                                                @endif
                                            </small></td>
                                        <td class="text-end">-{{number_format($discount)}}đ</td>
                                    </tr>
                                    <tr>
                                        <td>Phí Ship</td>
                                        <td class="text-end">-0đ</td>
                                    </tr>
                                    <tr class="border-top border-top-dashed fs-15">
                                        <th scope="row">Thành Tiền(VNĐ)</th>
                                        <th class="text-end">{{number_format($detailOrderUser->total_price)}}đ</th>
                                    </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>

                        </div>
                        <!--end card-body-->
                    </div><!--end col-->
                </div><!--end row-->
            </div>
            <!--end card-->
        </div>
        <!--end col-->
    </div>
@endsection

@section('css-lib')
    <link rel="shortcut icon" href="{{asset('theme/admin/assets/images/favicon.ico')}}">

    <!-- Layout config Js -->
    <script src="{{asset('theme/admin/assets/js/layout.js')}}"></script>
    <!-- Bootstrap Css -->
    <link href="{{asset('theme/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('theme/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('theme/admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{asset('theme/admin/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection

@section('script-lib')
    <script src="{{asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/plugins.js')}}"></script>

    <script src="{{asset('theme/admin/assets/js/pages/invoicedetails.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('theme/admin/assets/js/app.js')}}"></script>
@endsection
