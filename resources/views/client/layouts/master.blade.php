<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
          rel="stylesheet">

    <title>@yield('title')</title>


    <!-- Additional CSS Files -->
    <link rel="stylesheet" type="text/css" href="{{asset('theme/client/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('theme/client/assets/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('theme/client/assets/css/templatemo-hexashop.css')}}">

    <link rel="stylesheet" href="{{asset('theme/client/assets/css/owl-carousel.css')}}">

    <link rel="stylesheet" href="{{asset('theme/client/assets/css/lightbox.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
          integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
          crossorigin="anonymous" referrerpolicy="no-referrer"/>
    @yield('css-lib')
    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"--}}
    {{--          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
</head>

<body>

<!-- ***** Header Area Start ***** -->
<header class="header-area header-sticky">
    @include('client.layouts.header')
</header>


@yield('banner')


<main style="min-height: 200px; "  >
    @yield('content')
</main>

<!-- ***** Footer Start ***** -->
<footer>
    @include('client.layouts.footer')
</footer>


<!-- ***** Preloader Start ***** -->
<div id="preloader">
    <div class="jumper">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
@yield('script-lib')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
<!-- ***** Preloader End ***** -->
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js"--}}
{{--        integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g=="--}}
{{--        crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}
<!-- jQuery -->
<script src="{{asset('theme/client/assets/js/jquery-2.1.0.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('theme/client/assets/js/popper.js')}}"></script>
<script src="{{asset('theme/client/assets/js/bootstrap.min.js')}}"></script>

<!-- Plugins -->
<script src="{{asset('theme/client/assets/js/owl-carousel.js')}}"></script>
<script src="{{asset('theme/client/assets/js/accordions.js')}}"></script>
<script src="{{asset('theme/client/assets/js/datepicker.js')}}"></script>
<script src="{{asset('theme/client/assets/js/scrollreveal.min.js')}}"></script>
<script src="{{asset('theme/client/assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('theme/client/assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('theme/client/assets/js/imgfix.min.js')}}"></script>
<script src="{{asset('theme/client/assets/js/slick.js')}}"></script>
<script src="{{asset('theme/client/assets/js/lightbox.js')}}"></script>
<script src="{{asset('theme/client/assets/js/isotope.js')}}"></script>
<script src="{{asset('theme/client/assets/js/quantity.js')}}"></script>

<!-- Global Init -->
<script src="{{asset('theme/client/assets/js/custom.js')}}"></script>

<script>

    $(function () {
        var selectedClass = "";
        $("p").click(function () {
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("." + selectedClass).fadeOut();
            setTimeout(function () {
                $("." + selectedClass).fadeIn();
                $("#portfolio").fadeTo(50, 1);
            }, 500);

        });
    });

</script>

</body>
</html>
