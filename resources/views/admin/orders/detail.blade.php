@extends('admin.layouts.master')
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
@section('content')
    <div class="row">
        <div class="col-xl-3">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0">Thông Tin Tài Khoản</h5>
                        <div class="flex-shrink-0">
                            {{--                            <a href="javascript:void(0);" class="link-secondary">View Profile</a>--}}
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0 vstack gap-3">
                        <li>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <img src="{{asset('gallerys/avt_user/avt1.jpg')}}" alt="" class="avatar-sm rounded">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="fs-14 mb-1">{{$detailOrderUser->user->name}}</h6>
                                    <p class="text-muted mb-0">{{$detailOrderUser->user->role}}</p>
                                </div>
                            </div>
                        </li>
                        <li>
                            <i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{$detailOrderUser->user->email}}
                        </li>
                        <li>
                            <i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{$detailOrderUser->user->phone}}
                        </li>
                    </ul>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-map-pin-line align-middle me-1 text-muted"></i>
                        Người Nhận Hàng
                    </h5>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                        <li class="fw-medium fs-14">{{$detailOrderUser->user_name}}</li>
                        <li>{{$detailOrderUser->user_email}}</li>
                        <li>+{{$detailOrderUser->user_phone}}</li>
                        <li>{{$detailOrderUser->user_address}}</li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="d-flex">
                        <h5 class="card-title flex-grow-1 mb-0"><i
                                class="mdi mdi-truck-fast-outline align-middle me-1 text-muted"></i> Trạng Thái Đơn
                            Hàng
                        </h5>
                        {{--                        <div class="flex-shrink-0">--}}
                        {{--                            <a href="javascript:void(0);" class="badge bg-primary-subtle text-primary fs-11">Track--}}
                        {{--                                Order</a>--}}
                        {{--                        </div>--}}
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <lord-icon src="https://cdn.lordicon.com/uetqnvvg.json" trigger="loop"
                                   colors="primary:#405189,secondary:#0ab39c"
                                   style="width:80px;height:80px"></lord-icon>
                        <h5 class="fs-16 mt-2">{{$status_order}}</h5>
                    </div>
                    <form action="{{route('admin.orders.updateStatusOrder')}}" method="post"
                          class="d-flex align-items-center justify-content-center mb-2">
                        @csrf
                        <div class="flex-shrink-0">
                            <select name="status_order" id="" class="form-select">
                                @php($i=0)
                                @foreach(\App\Models\Orders::STATUS_ORDER as $val)
                                    <option
                                        value="{{$val['key']}}"
                                        @if($val['key'] == $detailOrderUser->status_order)
                                            selected
                                        @php($i = $val['index'])
                                        @endif
                                        @if($i < $val['index']) disabled @endif
                                    >
                                        {{$val['value']}}
                                    </option>
                                    @php($i++)
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <input type="hidden" name="order_id" value="{{$detailOrderUser->id}}">
                            <button type="submit" class="btn btn-outline-dark">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end card-->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0"><i class="ri-secure-payment-line align-bottom me-1 text-muted"></i>
                        Thông Tin Thanh Toán</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Loại:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{$payment}}</h6>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mb-2">
                        <div class="flex-shrink-0">
                            <p class="text-muted mb-0">Trạng Thái:</p>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <h6 class="mb-0">{{$status_payment}}</h6>
                        </div>
                    </div>
                    <form action="{{route('admin.orders.updateStatusPayment')}}" method="post"
                          class="d-flex align-items-center justify-content-center mb-2">
                        @csrf
                        <div class="flex-shrink-0">
                            <select name="status_payment" id="" class="form-select">
                                @php($i=0)
                                @foreach(\App\Models\Orders::STATUS_PAYMENT as $val)
                                    <option
                                        value="{{$val['key']}}"
                                        @if($val['key'] == $detailOrderUser->status_payment)
                                            selected
                                        @php($i = $val['index'])
                                        @endif
                                        @if($i < $val['index']) disabled @endif
                                    >
                                        {{$val['value']}}
                                    </option>
                                    @php($i++)
                                @endforeach
                            </select>
                        </div>
                        <div class="flex-grow-1 ms-2">
                            <input type="hidden" name="order_id" value="{{$detailOrderUser->id}}">
                            <button type="submit" class="btn btn-outline-dark">Lưu</button>
                        </div>
                    </form>
                </div>
            </div>
            <!--end card-->
        </div>
        <div class="col-xl-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title flex-grow-1 mb-0">Order #VL2667</h5>
                        <div class="flex-shrink-0">
                            <a href="{{route('admin.orders.invoice',$detailOrderUser->id)}}" class="btn btn-success btn-sm"><i
                                    class="ri-download-2-fill align-middle me-1"></i> Hóa Đơn</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-nowrap align-middle table-borderless mb-0">
                            <thead class="table-light text-muted">
                            <tr>
                                <th scope="col">Thông Tin Sản Phẩm</th>
                                <th scope="col">Giá Tiền</th>
                                <th scope="col">Số Lượng</th>
                                {{--                                <th scope="col">Rating</th>--}}
                                <th scope="col" class="text-end">Tổng Cộng</th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--                            @dd($detailOrderUser)--}}
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
                            <tr class="border-top border-top-dashed">
                                <td colspan="3"></td>
                                <td colspan="2" class="fw-medium p-0">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr>
                                            <td>Tổng :</td>
                                            <td class="text-end">{{number_format($totalPriceBefore)}}đ</td>
                                        </tr>
                                        <tr>
                                            <td>Mã Giảm
                                                <span class="text-muted">
                                                    @if($detailOrderUser->voucher)
                                                        ({{$detailOrderUser->voucher->code}})
                                                    @endif
                                                </span>
                                                :
                                            </td>
                                            <td class="text-end">-{{number_format($discount)}}đ</td>
                                        </tr>
                                        <tr>
                                            <td>Phí Ship :</td>
                                            <td class="text-end">0đ</td>
                                        </tr>
                                        <tr class="border-top border-top-dashed">
                                            <th scope="row">Thành Tiền (VNĐ) :</th>
                                            <th class="text-end">{{number_format($detailOrderUser->total_price)}}đ</th>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end card-->

        </div>
        <!--end col-->

        <!--end col-->
    </div>
@endsection
@section('script-lib')

    <script src="{{asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/plugins.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('theme/admin/assets/js/app.js')}}"></script>
@endsection

@section('css-lib')

    <!-- App favicon -->
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
