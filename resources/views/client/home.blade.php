@extends('client.layouts.master')
@section('title')
    Trang chủ
@endsection

@section('banner')
    <div class="main-banner" id="top">
        <div id="carouselExampleIndicators" class="carousel slide container-fluid" data-ride="carousel">
            <ol class="carousel-indicators">
                @foreach($bannerAll as $item)
                    <li data-target="#carouselExampleIndicators" data-slide-to="{{$item->index}}" @if($item->first) class="active @endif "></li>
                @endforeach
            </ol>
            <div class="carousel-inner">
                @foreach($bannerAll as $item)
                    <div class="carousel-item @if($loop->first) active @endif" style="width: 100%;height: 500px;object-fit: cover">
                        <img class="d-block w-100" src="{{\Illuminate\Support\Facades\Storage::url($item->url)}}"
                             alt="First slide">
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" ></span>
                <span class="sr-only" >Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
@endsection

@section('content')
    <section class="section" id="men">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Sản Phẩm Mới</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="men-item-carousel">
                        <div class="owl-men-item owl-carousel ">
                            @foreach($dataCatelogues as $catelogue)
                                <div class="item">
                                    <div class="thumb">
                                        <div class="hover-content">
                                            <a href="{{route('client.productList')}}" class="text-white">
                                                <h4>{{$catelogue['name']}}</h4>
                                            </a>
                                        </div>
                                        <img src="{{Storage::url($catelogue['cover'])}}" alt="">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Men Area Ends ***** -->

    <!-- ***** Women Area Starts ***** -->
    <section class="section" id="women">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Sản Phẩm Hot</h2>
                        {{--                        <span>Details to details is what makes Hexashop different from the other themes.</span>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="women-item-carousel">
                        <div class="owl-women-item owl-carousel">
                            @foreach($product_hot_deal as $product)
                                <div class="item">
                                    <div class="thumb">
                                        <a href="{{route('client.productDetail',$product['slug'])}}">
                                            <img
                                                src="{{Storage::url($product['img_thumbnail'])}}"
                                                alt="" height="400px">
                                        </a>
                                    </div>
                                    <div class="down-content">
                                        <div title="{{$product['name']}}">
                                            <h4>{{Str::limit($product['name'],30)}}</h4>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>{{number_format($product['price_sale'])}}đ</span>
                                            <ul class="stars">
                                                @for($i=0;$i<5;$i++)
                                                    <li><i class="fa fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Women Area Ends ***** -->

    <!-- ***** Kids Area Starts ***** -->
    <section class="section" id="kids">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-heading">
                        <h2>Sản Phẩm Giá Tốt</h2>
                        {{--                        <span>Details to details is what makes Hexashop different from the other themes.</span>--}}
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="kid-item-carousel">
                        <div class="owl-kid-item owl-carousel">
                            @foreach($product_good_deal as $product)
                                <div class="item">
                                    <div class="thumb">
                                        <a href="{{route('client.productDetail',$product['slug'])}}">
                                            <img
                                                src="{{Storage::url($product['img_thumbnail'])}}"
                                                alt="" height="400px">
                                        </a>
                                    </div>
                                    <div class="down-content">
                                        <div title="{{$product['name']}}">
                                            <h4>{{Str::limit($product['name'],30)}}</h4>
                                        </div>
                                        <div class="d-flex justify-content-between">
                                            <span>{{number_format($product['price_sale'])}}đ</span>
                                            <ul class="stars">
                                                @for($i=0;$i<5;$i++)
                                                    <li><i class="fa fa-star"></i></li>
                                                @endfor
                                            </ul>
                                        </div>

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Kids Area Ends ***** -->


    <!-- ***** Subscribe Area Starts ***** -->
    <div class="subscribe">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="section-heading">
                        <h2>Đăng ký thành viên, bạn có thể nhận được mã giá giá 30% </h2>
                        <span>Details to details is what makes Hexashop different from the other themes.</span>
                    </div>
                    <form id="subscribe" action="" method="get">
                        <div class="row">
                            <div class="col-lg-5">
                                <fieldset>
                                    <input name="name" type="text" id="name" placeholder="Your Name" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-5">
                                <fieldset>
                                    <input name="email" type="text" id="email" pattern="[^ @]*@[^ @]*"
                                           placeholder="Your Email Address" required="">
                                </fieldset>
                            </div>
                            <div class="col-lg-2">
                                <fieldset>
                                    <button type="submit" id="form-submit" class="main-dark-button"><i
                                            class="fa fa-paper-plane"></i></button>
                                </fieldset>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-6">
                            <ul>
                                <li>Store Location:<br><span>Sunny Isles Beach, FL 33160, United States</span></li>
                                <li>Phone:<br><span>010-020-0340</span></li>
                                <li>Office Location:<br><span>North Miami Beach</span></li>
                            </ul>
                        </div>
                        <div class="col-6">
                            <ul>
                                <li>Work Hours:<br><span>07:30 AM - 9:30 PM Daily</span></li>
                                <li>Email:<br><span>info@company.com</span></li>
                                <li>Social Media:<br><span><a href="#">Facebook</a>, <a href="#">Instagram</a>, <a
                                            href="#">Behance</a>, <a
                                            href="#">Linkedin</a></span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
