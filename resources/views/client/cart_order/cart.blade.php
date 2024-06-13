@extends('client.layouts.master')

@section('content')
    <section class="section" id="men" style="margin-top: 20px">
        <form action="{{route('client.payment')}}" method="post" class="container">
            @csrf
            <table class="table" style="min-height: 300px">
                <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">STT</th>
                    <th scope="col" class="col-5">Ảnh</th>
                    <th scope="col" class="col-2">Giá</th>
                    <th scope="col">Số Lượng</th>
                    <th scope="col" class="col-2">Tổng Tiền</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @php($totalPrice = 0)
                @foreach($cartUser as $cart)
                    <tr>
                        <th scope="row">
                            <input type="checkbox" name="addToCart[]" id="" value="{{$cart->id}}">
                        </th>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td class="d-flex">
                            <div class="">
                                <img
                                    src="{{Storage::url($cart->productVariant->product->img_thumbnail)}}"
                                    alt="" width="100px">
                            </div>
                            <div class="">
                                <strong>{{$cart->productVariant->product->name}}</strong>
                                <p>{{Str::upper($cart->productVariant->product_color->name)}}
                                    | {{$cart->productVariant->product_size->name}}</p>
                            </div>
                        </td>
                        <td>{{number_format($cart->productVariant->price)}}đ</td>
                        <td>{{$cart->quantity}}</td>
                        <td>{{number_format($cart->productVariant->price * $cart->quantity)}}đ</td>
                        <td>
                            <a href="{{route('client.deleteCart',$cart->id)}}" onclick="return confirm('Bạn có muốn xóa không?')">
                                <i class="fa-regular fa-trash-can text-danger" style="font-size: 25px"></i>
                            </a>
                        </td>
                    </tr>
                    @php($totalPrice += $cart->productVariant->price * $cart->quantity)
                @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end align-items-center">
                <h5 class="mx-3">
                    Thành Tiền: <strong>{{number_format($totalPrice)}}đ</strong>
                </h5>
                <button type="submit" class="btn btn-outline-secondary" name="addCart" value="1">Mua Hàng</button>
            </div>
        </form>
    </section>
@endsection
@section('title')
    Giỏ Hàng
@endsection
@section('lib-script')

@endsection

@section('lib-style')

@endsection
