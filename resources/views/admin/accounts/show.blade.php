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

    <form action="#" class="row g-3 pt-3">
        @csrf
        {{--    products--}}
        <div class="col-xxl-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Sản Phẩm</h4>
                    <div class="flex-shrink-0">
                        <div class="form-check form-switch form-switch-right form-switch-md">

                        </div>
                    </div>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="row">
                        <div class=" col-6 ">
                            <div class="col-12">
                                <label for="fullnameInput" class="form-label">Tên Sản Phẩm</label>
                                <input readonly type="text" class="form-control" id="fullnameInput"
                                       placeholder="Nhập tên sản phẩm" name="name" value="{{$product->name}}">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="fullnameInput" class="form-label">Mã Sản Phẩm</label>
                                <input readonly type="text" class="form-control" id="fullnameInput"
                                       placeholder="Nhập mã sản phẩm" name="sku" value="{{$product->sku}}">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="fullnameInput" class="form-label">Giá Gốc</label>
                                <input readonly type="number" class="form-control" id="fullnameInput"
                                       placeholder="Nhập giá gốc" name="price_regular"
                                       value="{{$product->price_regular}}">
                            </div>
                            <div class="col-12 mt-2">
                                <label for="fullnameInput" class="form-label">Giá Sale</label>
                                <input readonly type="number" class="form-control" id="fullnameInput"
                                       placeholder="Nhập giá sale" name="price_sale" value="{{$product->price_sale}}">
                            </div>

                            {{--                            <div class="col-12 mt-2">--}}
                            {{--                                <label for="compnayNameinput" class="form-label">Ảnh Sản Phẩm</label>--}}
                            {{--                                <div class="input-group">--}}
                            {{--                                    <input disabled type="file" class="form-control" id="inputGroupFile02"--}}
                            {{--                                           name="img_thumbnail">--}}
                            {{--                                    <label class="input-group-text" for="inputGroupFile02">Upload</label>--}}
                            {{--                                </div>--}}

                            {{--                            </div>--}}
                        </div>
                        <div class=" col-6 ">
                            <div class="col-12">
                                <label for="fullnameInput" class="form-label">Danh Mục Sản Phẩm</label>
                                <select disabled class="form-select mb-3" aria-label="Default select example"
                                        name="catelogue_id">
                                    <option hidden="">Chọn danh mục sản phẩm</option>
                                    @foreach($dataCatelogues as $itemCatelogue)
                                        <option value="{{$itemCatelogue->id}}"
                                                @if($itemCatelogue->id == $product->catelogue->id) selected @endif>{{$itemCatelogue->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 d-flex  mt-2">
                                <div class="form-check form-switch col-2" dir="ltr">
                                    <input disabled type="checkbox" class="form-check-input" id="customSwitchsizesm"
                                           checked
                                           name="is_active" @if($product->is_active) checked @endif>
                                    <label class="form-check-label" for="customSwitchsizesm">Is Active</label>
                                </div>
                                <div class="form-check form-switch col-3" dir="ltr">
                                    <input disabled type="checkbox" class="form-check-input" id="customSwitchsizesm"
                                           name="is_hot_deal" @if($product->is_hot_deal) checked @endif>
                                    <label class="form-check-label" for="customSwitchsizesm">Is Hot Deal</label>
                                </div>
                                <div class="form-check form-switch col-3" dir="ltr">
                                    <input disabled type="checkbox" class="form-check-input" id="customSwitchsizesm"
                                           name="is_good_deal" @if($product->is_good_deal) checked @endif>
                                    <label class="form-check-label" for="customSwitchsizesm">Is Good Deal</label>
                                </div>
                                <div class="form-check form-switch col-2" dir="ltr">
                                    <input disabled type="checkbox" class="form-check-input" id="customSwitchsizesm"
                                           name="is_new" @if($product->is_new) checked @endif>
                                    <label class="form-check-label" for="customSwitchsizesm">Is New</label>
                                </div>
                                <div class="form-check form-switch col-2" dir="ltr">
                                    <input disabled type="checkbox" class="form-check-input" id="customSwitchsizesm"
                                           name="is_home" @if($product->is_home) checked @endif>
                                    <label class="form-check-label" for="customSwitchsizesm">Is Home</label>
                                </div>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="exampleFormControlTextarea5" class="form-label">Mô Tả Ngắn</label>
                                <textarea readonly class="form-control" id="exampleFormControlTextarea5" rows="3"
                                          name="description">{{$product->description}}</textarea>
                            </div>

                            <div class="col-12 mt-2">
                                <label for="exampleFormControlTextarea5" class="form-label">Chất Liệu</label>
                                <textarea readonly class="form-control" id="exampleFormControlTextarea5" rows="1"
                                          name="material">{{$product->material}}</textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <label for="exampleFormControlTextarea5" class="form-label">Hướng Dẫn Sử Dụng</label>
                                <textarea readonly class="form-control" id="exampleFormControlTextarea5" rows="2"
                                          name="user_manual">{{$product->user_manual}}</textarea>
                            </div>

                        </div>

                        <div class="col-12 mt-2">
                            <label for="content" class="form-label">Nội Dung</label>
                            <textarea class="form-control" id="content"
                                      name="content" disabled>{{$product->content}}</textarea>
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
                            <div class="card-body">
                                <table id="alternative-pagination"
                                       class="table nowrap dt-responsive align-middle table-hover table-bordered"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>Màu Sắc</th>
                                        <th>Kích Thước</th>
                                        <th>Giá</th>
                                        <th>Số Lượng</th>
                                        <th>Hình Ảnh</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($product_variants as $key => $val)
                                        <tr>
                                            <td>
                                                <div
                                                        style="width: 50px;height: 50px;background: {{$val->product_color->name}}">
                                                </div>
                                            </td>
                                            <td>
                                                {{$val->product_size->name}}
                                            </td>
                                            <td>
                                                <input type="number" id="price"
                                                       name="product_variants[{{$val->product_color_id}}-{{$val->product_size_id}}][price]"
                                                       class="form-control" disabled value="{{$val->price}}">
                                            </td>
                                            <td>
                                                <input type="number" id="quantity"
                                                       name="product_variants[{{$val->product_color_id}}-{{$val->product_size_id}}][quantity]"
                                                       class="form-control" disabled value="{{$val->quantity}}">
                                            </td>
                                            <td>
                                                <input type="file"
                                                       name="product_variants[{{$val->product_color_id}}-{{$val->product_size_id}}][image]"
                                                       class="form-control" disabled>
                                            </td>
                                            <td @if($val->image) @endif>
                                                <img src="{{Storage::url($val->image)}}" alt="" width="50px">
                                            </td>
                                        </tr>
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
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control" id="product_img"
                                               name="img_thumbnail" disabled>
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                    <img src="{{Storage::url($product->img_thumbnail)}}" alt=""
                                         width="100px">
                                </div>
                                <div class="col-6 mt-2">
                                    <label for="compnayNameinput" class="form-label">Ảnh Chi Tiết Sản Phẩm</label>
                                    <div class="input-group mb-3">
                                        <input type="file" name="product_galleries[]" class="form-control"
                                               multiple="multiple" disabled>
                                        <label class="input-group-text" for="inputGroupFile02">Upload</label>
                                    </div>
                                    <div>
                                        @foreach($dataGalleries as $key => $val)
                                            <span style="margin: 0 10px 0 0">
                                            <img src="{{Storage::url($val->image)}}" alt="" width="100px">
                                            </span>
                                        @endforeach
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
                                        data-placeholder="-- Vui Lòng Chọn Thẻ Tag --" disabled>
                                    @foreach($dataTag as $key => $val)
                                        <option value="{{$val->id}}"
                                                @foreach($product->tags as $item)
                                                    @if($item->id === $val->id)
                                                        selected
                                                @endif
                                                @endforeach
                                        >{{$val->name}}</option>
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
                <button type="button" class="btn btn-primary"><a
                            href="{{route('admin.products.index')}}"
                            class="text-decoration-none text-white">Quay Về Trang Sản Phẩm</a>
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

    <script src="{{asset('theme/admin/assets/js/pages/datatables.init.js')}}"></script>

    <!-- Dashboard init -->
    <script src="{{asset('theme/admin/assets/libs/prismjs/prism.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('theme/admin/assets/js/app.js')}}"></script>
@endsection

@section('css-lib')

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css"/>
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css"/>

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">

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
