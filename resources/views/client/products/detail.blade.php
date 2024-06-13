@extends('client.layouts.master')
@section('title')
    Chi tiết sản phẩm
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
    <!-- ***** Product Area Starts ***** -->
    <section class="section" id="product">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-images">
                        <img src="{{Storage::url($productDetail['img_thumbnail'])}}" alt="">
                        {{--                        <img src="{{asset('theme/client/assets/images/single-product-02.jpg')}}" alt="">--}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <form action="{{route('client.cart')}}" method="post" class="right-content">
                        @csrf
                        <h4>{{$productDetail['name']}}</h4>
                        <div class="d-flex justify-content-between mt-3">
                            <p class="price text-danger">
                                {{number_format($productDetail->price_sale)}}đ
                                <span class="text-decoration-line-through ">
                                {{number_format($productDetail->price_regular)}}đ
                            </span>
                            </p>
                            <ul class="stars">
                                @for($i=1;$i<6;$i++)
                                    <li><i class="fa fa-star"></i></li>
                                @endfor
                            </ul>
                        </div>

                        <span>{{$productDetail['description']}}</span>
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleFormControlSelect2">Màu Sắc</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="product_color">
                                    <option value="0" hidden="">-- Vui lòng chọn màu sắc --</option>
                                    @foreach($productColor as $color)
                                        <option value="{{$color->id}}">
                                            {{$color->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label for="exampleFormControlSelect2">Dung Lượng</label>
                                <select class="form-control" id="exampleFormControlSelect2" name="product_size">
                                    <option value="0" hidden="">-- Vui lòng chọn dung lượng --</option>
                                    @foreach($productSize as $size)
                                        <option value="{{$size->id}}">
                                            {{$size->name}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="quantity-content">
                            <div class="row">
                                <h6>Số Lượng:</h6>

                                <div class="quantity buttons_added ml-3">
                                    <input type="button" value="-" class="minus">
                                    <input type="number" step="1" min="1"
                                           max="" name="quantity" value="1"
                                           title="Qty"
                                           class="input-text qty text"
                                           pattern=""
                                           inputmode=""><input
                                        type="button" value="+" class="plus">
                                </div>
                            </div>
                        </div>
                        <div class="total ">
                            <input type="hidden" name="product_id" value="{{$productDetail->id}}">
                            <div class="main-border-button text-center">
                                <button type="submit" class="btn btn-outline-dark">Thêm Giỏ Hàng</button>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- ***** Product Area Ends ***** -->
@endsection
