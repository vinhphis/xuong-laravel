@extends('admin.layouts.master')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Form Layout</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                        <li class="breadcrumb-item active">Form Layout</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>
    <!-- end page title -->
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Cập Nhật Danh Mục Sản Phẩm</h4>
                <div class="flex-shrink-0">
                    <div class="form-check form-switch form-switch-right form-switch-md">

                    </div>
                </div>
            </div><!-- end card header -->

            <div class="card-body">

                <div class="live-preview">
                    <form action="{{route('admin.catelogues.update',$catelogue)}}"
                          enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="compnayNameinput" class="form-label">Tên Danh Mục</label>
                                    <input type="text" class="form-control" placeholder="Nhập tên danh mục"
                                           id="compnayNameinput" name="name"
                                           @if($catelogue) value="{{$catelogue->name}}" @endif>
                                </div>
                            </div><!--end col-->

                            <div class="col-12">
                                <label for="compnayNameinput" class="form-label">Ảnh Danh Mục</label>
                                <div class="input-group">
                                    <input type="file" class="form-control" id="inputGroupFile02" name="cover">
                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                </div>
                                <img alt="" @if($catelogue) src="{{Storage::url($catelogue->cover)}}"
                                     height="100" @endif >
                            </div>


                            <div class="form-check form-switch form-switch-md col-12 mx-3 mt-3" dir="ltr">
                                <input type="checkbox" class="form-check-input" id="customSwitchsizemd"
                                       @checked($catelogue->is_active)
                                       name="is_active">
                                <label class="form-check-label" for="customSwitchsizemd">Active</label>
                            </div>

                            <div class="col-12">
                                <div class="text-center">
{{--                                    <input type="hidden" name="id" value="{{$catelogue->id}}">--}}
                                    <button type="reset" class="btn btn-dark">Đặt Lại</button>
                                    <button type="submit"
                                            class="btn btn-primary">Cập Nhật</button>
                                </div>
                            </div><!--end col-->
                        </div><!--end row-->
                    </form>
                </div>

            </div>
        </div>
    </div> <!-- end col -->
@endsection
@section('script-lib')

    <!-- prismjs plugin -->
    <script src=""></script>
    <script src="{{asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/plugins.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('theme/admin/assets/libs/prismjs/prism.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('theme/admin/assets/js/app.js')}}"></script>
@endsection

@section('css-lib')

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
