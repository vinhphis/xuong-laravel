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
                <h4 class="mb-sm-0">Thêm Sản Phẩm</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Sản Phẩm</a></li>
                        <li class="breadcrumb-item active">Thêm Sản Phẩm</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $key => $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- end page title -->
    <form action="{{route('admin.products.store')}}" class="row g-3 pt-3" method="post"
          enctype="multipart/form-data">
        @csrf
        {{--    products--}}
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sản Phẩm</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class=" col-6 ">
                            <div class="col-12">
                                <label for="fullnameInput" class="form-label">Tên Sản Phẩm</label>
                                <input type="text" class="form-control" id="fullnameInput"
                                       placeholder="Nhập tên sản phẩm" name="name" value="{{old('name')}}">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="sku" class="form-label">Mã Sản Phẩm</label>
                                <input type="text" class="form-control" id="sku"
                                       placeholder="Nhập mã sản phẩm" name="sku"
                                       value="{{Str::random(8)}}">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="fullnameInput" class="form-label">Giá Gốc</label>
                                <input type="number" class="form-control" id="fullnameInput"
                                       placeholder="Nhập giá gốc" name="price_regular" value="{{old('price_regular')}}">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="fullnameInput" class="form-label">Giá Sale</label>
                                <input type="number" class="form-control" id="fullnameInput"
                                       placeholder="Nhập giá sale" name="price_sale">
                            </div>
                        </div>
                        <div class=" col-6 ">
                            <div class="col-12">
                                <label for="fullnameInput" class="form-label">Danh Mục Sản Phẩm</label>
                                <select class="form-select mb-3" aria-label="Default select example"
                                        name="catelogue_id">
                                    <option hidden="" value="0">Chọn danh mục sản phẩm</option>
                                    @foreach($dataCatelogues as $itemCatelogue)
                                        <option value="{{$itemCatelogue->id}}">{{$itemCatelogue->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 d-flex  mt-2">
                                @foreach($is as $key =>$val)
                                    <div class="form-check form-switch col-{{$val}}" dir="ltr">
                                        <input type="checkbox" class="form-check-input" id="{{$key}}"
                                               @if($loop->first) checked @endif
                                               name="{{$key}}" value="1">
                                        <label class="form-check-label"
                                               for="{{$key}}">{{Str::convertCase($key,MB_CASE_TITLE)}}</label>
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-12 mt-2">
                                <label for="exampleFormControlTextarea5" class="form-label">Mô Tả Ngắn</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3"
                                          name="description">Sản phẩm tốt</textarea>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="exampleFormControlTextarea5" class="form-label">Chất Liệu</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="1"
                                          name="material">đất</textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="exampleFormControlTextarea5" class="form-label">Hướng Dẫn Sử Dụng</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="2"
                                          name="user_manual">sử dụng dưới nước</textarea>
                            </div>

                        </div>

                        <div class="col-12 mt-2">
                            <label for="content" class="form-label">Nội Dung</label>
                            <textarea class="form-control" id="content"
                                      name="content">quăng quật thoải mái</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- product variants--}}
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Biến Thể Sản Phẩm</h5>
                            </div>
                            <div class="table-responsive overflow-scroll" style="height: 430px">
                                <table class="table table-striped table-nowrap align-middle mb-0">
                                    <thead>
                                    <tr>
                                        <th>Màu Sắc</th>
                                        <th>Kích Thước</th>
                                        <th>Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Hình Ảnh</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dataColor as $color)
                                        @php( $flagRowspan = true)
                                        @foreach($dataSize as $size)
                                            <tr>
                                                @if($flagRowspan)
                                                    <td rowspan="{{count($dataSize)}}" style="vertical-align: middle">
                                                        <div
                                                            style="width: 50px;height: 50px;background: {{$color->color_code}};border: 1px solid">
                                                        </div>
                                                    </td>
                                                @endif
                                                @php($flagRowspan = false)
                                                <td>
                                                    {{$size->name}}
                                                </td>
                                                <td>
                                                    <input type="number" id="price"
                                                           name="product_variants[{{$color->id}}-{{$size->id}}][price]"
                                                           class="form-control">
                                                </td>
                                                <td>
                                                    <input type="number" id="quantity"
                                                           name="product_variants[{{$color->id}}-{{$size->id}}][quantity]"
                                                           class="form-control">
                                                </td>
                                                <td>
                                                    <input type="file"
                                                           name="product_variants[{{$color->id}}-{{$size->id}}][image]"
                                                           class="form-control">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- galleries--}}
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Ảnh Sản Phẩm</h5>
                            </div>
                            <div class="card-body row">
                                <div class="col-6 mt-2">
                                    <label for="product_img" class="form-label">Ảnh Sản Phẩm Chính</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="product_img"
                                               name="img_thumbnail">
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="compnayNameinput" class="form-label">Ảnh Chi Tiết Sản Phẩm</label>
                                    <div class="input-group">
                                        <input type="file" name="product_galleries[]" class="form-control"
                                               multiple="multiple">
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        {{-- product tags--}}
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-body">
                    <div class="live-preview">

                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Tag</h5>
                            </div>
                            <div class="card-body">
                                <select class="js-example-basic-multiple" name="product_tags[]" multiple="multiple"
                                        data-placeholder="-- Vui Lòng Chọn Thẻ Tag --">
                                    @foreach($dataTag as $key => $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-12  mb-3">
            <div class="text-center">
                <button type="reset" class="btn btn-dark">Đặt Lại</button>
                <button type="submit" class="btn btn-primary">Thêm Mới
                </button>
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
    {{--    <script src="{{asset('theme/admin/assets/libs/prismjs/prism.js')}}"></script>--}}

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

@endsection
