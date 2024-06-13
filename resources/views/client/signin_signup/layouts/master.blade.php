<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Sign In | Velzon - Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('theme/admin/assets/images/favicon.ico')}}">


    <!-- Bootstrap Css -->
    <link href="{{asset('theme/admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons Css -->
    <link href="{{asset('theme/admin/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- App Css-->
    <link href="{{asset('theme/admin/assets/css/app.min.css')}}" rel="stylesheet" type="text/css"/>
    <!-- custom Css-->
    <link href="{{asset('theme/admin/assets/css/custom.min.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body>

<!-- auth-page wrapper -->

<main>
    @yield('content')
</main>
<!-- end auth-page-wrapper -->

<!-- JAVASCRIPT -->
<!-- Layout config Js -->
<script src="{{asset('theme/admin/assets/js/layout.js')}}"></script>
<script src="{{asset('theme/admin/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('theme/admin/assets/libs/node-waves/waves.min.js')}}"></script>
<script src="{{asset('theme/admin/assets/libs/feather-icons/feather.min.js')}}"></script>
<script src="{{asset('theme/admin/assets/js/pages/plugins/lord-icon-2.1.0.js')}}"></script>
<script src="{{asset('theme/admin/assets/js/plugins.js')}}"></script>

<!-- password-addon init -->
<script src="{{asset('theme/admin/assets/js/pages/password-addon.init.js')}}"></script>
<script src="{{asset('theme/admin/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>

