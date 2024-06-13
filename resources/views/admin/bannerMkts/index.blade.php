@extends('admin.layouts.master')


@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Basic Tables</h4>

                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                        <li class="breadcrumb-item active">Basic Tables</li>
                    </ol>
                </div>

            </div>
        </div>
    </div>

    @if(session('msg'))
        <div class="alert alert-success" role="alert">
            <strong>{{session('msg')}}</strong>
        </div>
    @endif

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">Ảnh Banner</h4>

                    <button type="button" class="btn btn-primary ">
                        <a href="{{route('admin.bannerMkts.create')}}" class="text-decoration-none text-white">
                            Thêm Mới
                        </a>
                    </button>

                </div>

                <div class="card-body">
                    <div class="live-preview">
                        <div class="row">

                            <div class="col-xl-12">
                                <div class="table-responsive mt-4 mt-xl-0">
                                    <table
                                        class="table table-hover table-striped align-middle table-nowrap mb-0 text-center">
                                        <thead>
                                        <tr>
                                            <th scope="col">STT</th>
                                            <th scope="col">Ảnh</th>
                                            <th scope="col">Trạng Thái</th>
                                            <th scope="col"
                                                class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                                Thao Tác
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($bannerAll as $item)
                                            <tr>
                                                <td class="fw-medium">{{$loop->iteration}}</td>
                                                <td>
                                                    <img src="{{Storage::url($item->url)}}" alt="" height="100px">
                                                </td>
                                                <td>
                                                    {!! $item->is_active
                                                        ? '<span class="badge bg-primary">Hoạt Động</span>'
                                                        : '<span class="badge bg-danger">Không Hoạt Động</span>'
                                                    !!}
                                                </td>
                                                <td class="@if(\Illuminate\Support\Facades\Auth::user()->role !== \App\Models\User::USER_ADMIN) d-none @endif">
                                                    <button type="button" class="btn btn-warning ">
                                                        <a href="{{route('admin.catelogues.edit',$item)}}"
                                                           class="text-decoration-none text-white">Sửa</a>
                                                    </button>
                                                    <form action="{{route('admin.catelogues.destroy',$item)}}}"
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

                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>

                </div><!-- end card-body -->
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>


    {{--                    Start modal--}}
    <div class="card-body">
        <div class="live-preview">
            <div>
                <div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel"
                     aria-hidden="true" style="display: none;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="myModalLabel">
                                    Thêm Mới Danh Mục
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{route('admin.catelogues.store')}}"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="row">

                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="compnayNameinput" class="form-label">Tên Danh Mục</label>
                                                <input type="text" class="form-control" placeholder="Nhập tên danh mục"
                                                       id="compnayNameinput" name="name">
                                            </div>
                                        </div><!--end col-->

                                        <div class="col-12">
                                            <label for="compnayNameinput" class="form-label">Ảnh Danh Mục</label>
                                            <input type="file" name="cover" id="">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="dropzone">
                                                        <div class="fallback">
                                                            <input type="file" name="cover" id="fileInput">
                                                        </div>
                                                        <div class="dz-message needsclick">
                                                            <div class="mb-3">
                                                                <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                                            </div>
                                                            <h4>Drop files here or click to upload.</h4>
                                                        </div>
                                                    </div>

                                                    <ul class="list-unstyled mb-0" id="dropzone-preview">
                                                        <li class="mt-2" id="dropzone-preview-list">
                                                            <!-- This is used as the file preview template -->
                                                            <div class="border rounded">
                                                                <div class="d-flex p-2">
                                                                    <div class="flex-shrink-0 me-3">
                                                                        <div class="avatar-sm bg-light rounded">
                                                                            <img data-dz-thumbnail
                                                                                 class="img-fluid rounded d-block"
                                                                                 src="{{asset('theme/admin/assets/images/new-document.png')}}"
                                                                                 alt="Dropzone-Image"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-grow-1">
                                                                        <div class="pt-1">
                                                                            <h5 class="fs-14 mb-1" data-dz-name>
                                                                                &nbsp;</h5>
                                                                            <p class="fs-13 text-muted mb-0"
                                                                               data-dz-size></p>
                                                                            <strong class="error text-danger"
                                                                                    data-dz-errormessage></strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="flex-shrink-0 ms-3">
                                                                        <button data-dz-remove
                                                                                class="btn btn-sm btn-danger">Delete
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    <!-- end dropzon-preview -->
                                                </div>
                                                <!-- end card body -->
                                            </div>
                                            <!-- end card -->
                                        </div> <!-- end col -->

                                        <div class="form-check form-switch form-switch-md col-6" dir="ltr">
                                            <input type="checkbox" class="form-check-input" id="customSwitchsizemd"
                                                   checked name="is_active">
                                            <label class="form-check-label" for="customSwitchsizemd">Active</label>
                                        </div>

                                        <div class="col-6">
                                            <div class="text-end">
                                                <button type="submit" class="btn btn-primary">Thêm Mới</button>
                                            </div>
                                        </div><!--end col-->
                                    </div><!--end row-->
                                </form>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{--                    End modal--}}

@endsection



@section('script-lib')
    <script src="{{asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
    <script src="{{asset('theme/admin/assets/js/plugins.js')}}"></script>


    <!-- dropzone min -->
    <script src="{{asset('theme/admin/assets/libs/dropzone/dropzone-min.js')}}"></script>
    <!-- filepond js -->
    <script src="{{asset('theme/admin/assets/libs/filepond/filepond.min.js')}}"></script>
    <script
        src="{{asset('theme/admin/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js')}}"></script>
    <script
        src="{{asset('theme/admin/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js')}}"></script>
    <script
        src="{{asset('theme/admin/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js')}}"></script>
    <script
        src="{{asset('theme/admin/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js')}}"></script>

    <script src="{{asset('theme/admin/assets/js/pages/form-file-upload.init.js')}}"></script>


    <!-- prismjs plugin -->
    <script src="{{asset('theme/admin/assets/libs/prismjs/prism.js')}}"></script>

    <!-- Lord Icon -->
    <script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>

    <!-- Modal Js -->
    <script src="{{asset('theme/admin/assets/js/pages/modal.init.js')}}"></script>


    <script src="{{asset('theme/admin/assets/js/app.js')}}"></script>

@endsection

@section('css-lib')
    <link rel="shortcut icon" href="{{asset('theme/admin/assets/images/favicon.ico')}}">

    <!-- dropzone css -->
    <link rel="stylesheet" href="{{asset('theme/admin/assets/libs/dropzone/dropzone.css')}}" type="text/css"/>

    <!-- Filepond css -->
    <link rel="stylesheet" href="{{asset('theme/admin/assets/libs/filepond/filepond.min.css')}}" type="text/css"/>
    <link rel="stylesheet"
          href="{{asset('theme/admin/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css')}}">
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
