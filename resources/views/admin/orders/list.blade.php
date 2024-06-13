@extends('admin.layouts.master')


@section('content')

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Datatables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Datatables</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->

    @if(session('msg'))
        <div class="alert alert-success" role="alert">
            <strong>{{session('msg')}}</strong>
        </div>
    @endif


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h5 class="card-title mb-0">Đơn Hàng</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Họ tên</th>
                                {{--                                <th scope="col">Số Điện Thoại</th>--}}
                                {{--                                <th scope="col">Email</th>--}}
                                {{--                                <th scope="col">Địa Chỉ</th>--}}
                                <th scope="col">Thanh Toán</th>
                                <th scope="col">Tổng Tiền</th>
                                <th scope="col">Trạng Thái Đơn Hàng</th>
                                <th scope="col">Trạng Thái Thanh Toán</th>
                                <th scope="col">Ngày Đặt</th>
                                <th class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                    Tác Vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($allOrderUser as $order)
                                @php
                                    if($order->status_order === \App\Models\Orders::STATUS_ORDER_PENDING) $status_order = 'Chờ xác nhận';
                                    if($order->status_order === \App\Models\Orders::STATUS_ORDER_CONFIRMED) $status_order = 'Đã xác nhận';
                                    if($order->status_order === \App\Models\Orders::STATUS_ORDER_PREPARING_GOODS) $status_order = 'Đang chuẩn bị hàng';
                                    if($order->status_order === \App\Models\Orders::STATUS_ORDER_SHIPPING) $status_order = 'Đang vận chuyển';
                                    if($order->status_order === \App\Models\Orders::STATUS_ORDER_DELIVERED) $status_order = 'Đã giao hàng';
                                    if($order->status_order === \App\Models\Orders::STATUS_ORDER_CANCELED) $status_order = 'Đơn hàng đã bị hủy';

                                    if($order->status_payment === \App\Models\Orders::STATUS_PAYMENT_UNPAID) $status_payment = 'Chưa thanh toán';
                                    if($order->status_payment === \App\Models\Orders::STATUS_PAYMENT_PAID) $status_payment = 'Đã thanh toán';
                                @endphp
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$order->user_name}}</td>
                                    {{--                                    <td>{{$order->user_phone}}</td>--}}
                                    {{--                                    <td>{{ $order->user_email }}</td>--}}
                                    {{--                                    <td>{{$order->user_address}}</td>--}}
                                    <td>{{$order->payment == 'delivery' ? 'Thanh toán khi nhận hàng' : 'Thanh toán online'}}</td>
                                    <td>{{number_format($order->total_price)}}đ</td>
                                    <td>{{$status_order}}</td>
                                    <td>{{$status_payment}}</td>
                                    <td>{{$order->created_at}}</td>
                                    <td class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                        <button class="btn btn-info"><a
                                                href="{{route('admin.orders.detail',$order->id)}}"
                                                class="text-white">Chi
                                                Tiết</a></button>
                                        @if($order->status_order != \App\Models\Orders::STATUS_ORDER_CANCELED
                                            && $order->status_order != \App\Models\Orders::STATUS_ORDER_DELIVERED)
                                            <form action="{{route('admin.orders.destroy',$order)}}" method="post"
                                                  class="mt-2">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hủy Đơn</button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center mt-3"><h4>Chưa có đơn hàng nào được mua</h4></td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--end row-->

@endsection



@section('script-lib')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="{{asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/plugins.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('theme/admin/assets/js/pages/datatables.init.js')}}"></script>

    <script src="{{asset('theme/admin/assets/js/app.js')}}"></script>
@endsection

@section('css-lib')
    <link rel="shortcut icon" href="{{asset('theme/admin/assets/images/favicon.ico')}}">


    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

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
