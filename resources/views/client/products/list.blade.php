@extends('client.layouts.master')
@section('title')
    Danh sách sản phẩm
@endsection

@section('banner')
    <!-- ***** Main Banner Area Start ***** -->
    <div class="page-heading" id="top">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="inner-content">
                        <h2>Check Our Products</h2>
                        <span>Awesome &amp; Creative HTML CSS layout by TemplateMo</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ***** Main Banner Area End ***** -->
@endsection

@section('content')

    <!-- ***** Products Area Starts ***** -->
    <section class="section" id="products">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Danh Sách Sản Phẩm</h2>
                        <span>Check out all of our products.</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

                @forelse($productList as $product)
                    <div class="col-lg-4">
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
                    </div>
                @empty
{{--                    <div class=" d-flex justify-content-center ">--}}
                        <h4 class="text-danger">Không có dữ liệu...</h4>
{{--                    </div>--}}
                @endforelse

                <div class="col-lg-12">
                </div>
            </div>
        </div>
    </section>
    <!-- ***** Products Area Ends ***** -->
@endsection
