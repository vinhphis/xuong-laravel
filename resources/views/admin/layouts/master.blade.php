<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
      data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8"/>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    @yield('css-lib')

</head>

<body>

<div id="layout-wrapper">

    {{--   Start header--}}
    @include('admin.layouts.header')
    {{--   End header--}}

    <!-- removeNotificationModal -->
    <div id="removeNotificationModal" class="modal fade zoomIn" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            id="NotificationModalbtn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                                   colors="primary:#f7b84b,secondary:#f06548"
                                   style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Are you sure ?</h4>
                            <p class="text-muted mx-4 mb-0">Are you sure you want to remove this Notification ?</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-notification">Yes, Delete It!
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{--    Start sidebar--}}
    @include('admin.layouts.sidebar')
    {{--    End sidebar--}}


    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">

                {{--        Start content --}}
                @yield('content')
                {{--        End content --}}

                {{--   Start footer     --}}
                @include('admin.layouts.footer')
                {{--   End footer     --}}

            </div>
        </div>
    </div>
    <!-- end main content-->

</div>

@include('admin.layouts.plugin')

<script>
    const PATH_URL = '{{ asset('theme/admin') }}';
</script>
<!-- JAVASCRIPT -->
@yield('script-lib')

</body>

</html>
