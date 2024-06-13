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
                    <h5 class="card-title mb-0">Sản Phẩm</h5>
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
                                <th>STT</th>
                                <th>Ảnh</th>
                                <th>Tên</th>
                                <th>Giá Gốc</th>
                                <th>Giá Sale</th>
                                {{--                                <th>Tag</th>--}}
                                <th>Is Active</th>
                                <th>Is Hot Deal</th>
                                <th>Is Home</th>
                                <th>Is Good Deal</th>
                                <th>Is New</th>
                                <th>Lượt Xem</th>
                                <th class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                    Tác Vụ
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $item)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td class="">
                                        @if(!empty($item->img_thumbnail))
                                            <img src="{{Storage::url($item->img_thumbnail)}}"
                                                 width="150px">
                                        @else
                                            <strong>Hình ảnh không tồn tại</strong>
                                        @endif

                                    </td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ number_format($item->price_regular,0,',') }}đ</td>
                                    <td>{{ number_format($item->price_sale,0,',') }}đ</td>
                                    {{--                                    <td>--}}
                                    {{--                                        @foreach($item->tags as $key => $val)--}}
                                    {{--                                            <span class="badge bg-info">{{$val->name}}</span>--}}
                                    {{--                                        @endforeach--}}
                                    {{--                                    </td>--}}
                                    <td>{!!$item->is_active ? '<span class="badge bg-primary">Hoạt động</span>' : '<span class="badge bg-warning">Không hoạt động</span>'!!} </td>
                                    <td>{!!$item->is_hot_deal? '<span class="badge bg-primary">Hoạt động</span>' : '<span class="badge bg-warning">Không hoạt động</span>'!!}</td>
                                    <td>{!!$item->is_home? '<span class="badge bg-primary">Hoạt động</span>' : '<span class="badge bg-warning">Không hoạt động</span>'!!}</td>
                                    <td>{!!$item->is_good_deal? '<span class="badge bg-primary">Hoạt động</span>' : '<span class="badge bg-warning">Không hoạt động</span>'!!}</td>
                                    <td>{!!$item->is_new? '<span class="badge bg-primary">Hoạt động</span>' : '<span class="badge bg-warning">Không hoạt động</span>'!!}</td>
                                    <td>{{$item->view_count}}</td>
                                    <td class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                        <button class="btn btn-info">
                                            <a href="{{route('admin.products.show', $item)}}"
                                               class="text-decoration-none text-white">Chi Tiết</a>
                                        </button>
                                        <button class="btn btn-warning mt-2">
                                            <a href="{{route('admin.products.edit', $item)}}"
                                               class="text-decoration-none text-white">Cập Nhật</a>
                                        </button>
                                        <form action="{{route('admin.products.destroy',$item)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger mt-2"
                                                    onclick="return confirm('Bạn có muốn xóa {{Str::upper($item->name)}} không')">
                                                Xóa
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
