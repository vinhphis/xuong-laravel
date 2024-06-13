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
                    <h5 class="card-title mb-0">Mã Giảm Giá</h5>
                    <button class="btn btn-primary">
                        <a class="text-decoration-none text-light"
                           href="{{route('admin.products.create')}}">Thêm Mới</a>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered"
                               style="width:100%">
                            <thead>
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên</th>
                                <th scope="col">Mã</th>
                                <th scope="col">Giảm Giá</th>
                                <th scope="col">Số Lượng</th>
                                <th scope="col">Giá Tối Thiểu</th>
                                <th scope="col">Tổng Tiền Giảm Giá</th>
                                <th scope="col">Loại Mã Giảm Giá</th>
                                <th scope="col">Hoạt Động</th>
                                <th scope="col"
                                    class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                    Tác Vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataVoucher as $voucher)
                                <tr>
                                    <td class="fw-medium">{{$loop->iteration}}</td>
                                    <td> {{$voucher->name}} </td>
                                    <td> {{$voucher->code}} </td>
                                    <td> {{$voucher->discount}} </td>
                                    <td> {{$voucher->quantity}} </td>
                                    <td> {{number_format($voucher->min_price)}}đ</td>
                                    <td> {{number_format($voucher->total)}}đ</td>
                                    <td>
                                        {!! $voucher->type == 'fixed_price'
                                            ? '<span class=" ">Mã cố định</span>'
                                            : '<span class=" ">Mã phần trăm</span>'
                                        !!}
                                    </td>
                                    <td>
                                        {!! $voucher->is_active
                                            ? '<span class="badge bg-primary">Hoạt Động</span>'
                                            : '<span class="badge bg-danger">Không Hoạt Động</span>'
                                        !!}
                                    </td>
                                    <td class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                        <button type="button" class="btn btn-warning ">
                                            <a href="{{route('admin.vouchers.edit',$voucher)}}"
                                               class="text-decoration-none text-white">Sửa</a>
                                        </button>
                                        <form action="{{route('admin.vouchers.destroy',$voucher)}}}"
                                              method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger mt-2"
                                                    onclick="return confirm('Bạn có muốn xóa không?')">Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
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
