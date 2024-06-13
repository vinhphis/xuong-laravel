@extends('admin.layouts.master')
@php
    $is = [
        'is_active' => 2,
        'is_hot_deal' => 3,
        'is_good_deal' => 3,
        'is_new' => 2,
        'is_home' => 2,
    ];
@endphp
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
    <form action="{{route('admin.users.update',$user)}}" class="row g-3 pt-3" method="post">
        @csrf
        @method('PUT')

        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Cập Nhật Tài Khoản</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">

                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">

                        <div class=" col-6 ">
                            <div class="col-12">
                                <label for="fullnameInput" class="form-label">Tên Người Dùng</label>
                                <input type="text" class="form-control" id="fullnameInput"
                                       placeholder="Nhập tên người dùng" name="name" readonly
                                       value="{{$user->name}}">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="fullnameInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="fullnameInput"
                                       placeholder="Nhập mã sản phẩm" name="email" readonly
                                       value="{{$user->email}}">
                            </div>
                            <div class="col-12">
                                <label for="fullnameInput" class="form-label">Chức Vụ</label>
                                <select class="form-select mb-3" aria-label="Default select example"
                                        name="role">
                                    <option hidden="">Chọn danh mục sản phẩm</option>
                                    @foreach($role as $item)
                                        <option value="{{$item}}"
                                                @if($item === $user->role) selected @endif >
                                            {{$item}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> <!-- end col -->


        <div class="col-xxl-12  mb-3">
            <div class="text-center">
                <button type="reset" class="btn btn-dark">Đặt Lại</button>
                <button type="submit" class="btn btn-primary">Cập Nhật</button>
            </div>
        </div>
    </form>
@endsection
@section('script-lib')
    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{asset('theme/admin/assets/js/pages/select2.init.js')}}"></script>

    <!-- ckeditor -->
    <script src="https:////cdn.ckeditor.com/4.8.0/basic/ckeditor.js"></script>
    <!-- prismjs plugin -->
    <script>
        CKEDITOR.replace('content');
    </script>


    <script src="{{asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/plugins.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('theme/admin/assets/libs/prismjs/prism.js')}}"></script>

    <!-- ckeditor -->
    <script src="{{asset('theme/admin/assets/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js')}}"></script>

    <!-- quill js -->
    <script src="{{asset('theme/admin/assets/libs/quill/quill.min.js')}}"></script>

    <!-- init js -->
    <script src="{{asset('theme/admin/assets/js/pages/form-editor.init.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('theme/admin/assets/js/app.js')}}"></script>
@endsection

@section('css-lib')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

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

    <!-- quill css -->
    <link href="{{asset('theme/admin/assets/libs/quill/quill.core.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('theme/admin/assets/libs/quill/quill.bubble.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('theme/admin/assets/libs/quill/quill.snow.css')}}" rel="stylesheet" type="text/css"/>
@endsection
