@extends('client.layouts.master')

@section('content')
    <section class="section" id="men" style="margin-top: 20px">
        <div class="container">
            <form class="row" action="{{route('client.payment')}}" method="post">
                @csrf
                <div class="col-7">
                    <h4 class="mb-3">Thông Tin Người Nhận</h4>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <label for="hoTen">Họ tên</label>
                            <input type="text" class="form-control  @error('user_user') is-invalid @enderror"
                                   name="user_name" placeholder="Nhập họ tên"
                                   value="{{ old('user_name') ? old('user_name') : $userDetail->name}}">
                            @error('user_name')
                            <span class="invalid-feedback" role="alert">
                                  <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-7">
                            <label for="soDienThoai">Số Điện Thoại</label>
                            <input type="number" class="form-control @error('user_phone') is-invalid @enderror "
                                   name="user_phone"
                                   value="{{ old('user_phone') ? old('user_phone') : $userDetail->phone}}"
                                   placeholder="Nhập số điện thoại">
                            @error('user_phone')
                            <span class="invalid-feedback" role="alert">
                                   <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control  @error('user_email') is-invalid @enderror"
                               name="user_email" placeholder="acb@gmail.com"
                               value="{{ old('user_email') ? old('user_email') : $userDetail->email}}">
                        @error('user_email')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="diaChi">Địa Chỉ</label>
                        <input type="text" class="form-control  @error('user_address') is-invalid @enderror"
                               name="user_address" placeholder="xã, huyện, thành phố"
                               value="{{ old('user_address') ? old('user_address') : $userDetail->address}}">
                        @error('user_address')
                        <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="ghiChu">Ghi Chú</label>
                        <textarea class="form-control @error('user_anote') is-invalid @enderror" name=user_note
                                  rows="3">
                            {{ old('user_note')}}
                        </textarea>
                        @error('user_note')
                        <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <h4 class="mb-3">Phương Thức Thanh Toán</h4>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="gridRadios1" value="delivery"
                               checked>
                        <label class="form-check-label" for="gridRadios1" style="cursor: pointer">
                            Thanh Toán Khi Nhận Hàng
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="payment" id="gridRadios2" value="online">
                        <label class="form-check-label" for="gridRadios2" style="cursor: pointer">
                            Thanh Toán Online
                        </label>
                    </div>
                    <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="postPay" id="gridRadios3" value="true"
                               disabled>
                        <label class="form-check-label" for="gridRadios3" style="cursor: pointer">
                            Thanh Toán Trả Sau (Sắp ra mắt)
                        </label>
                    </div>
                </div>
                <div class="col-5 ">
                    <h4 class="mb-3">Thông Tin Đơn Hàng</h4>
                    <table class="table border-bottom">
                        @php($totalPrice = 0)
                        @foreach($carts as $item)
                            <tr class="row">
                                <td class="d-flex col-12">
                                    <div class="">
                                        <img src="{{Storage::url($item->productVariant->product->img_thumbnail)}}"
                                             alt="" width="100px">
                                    </div>
                                    <div class="col-10">
                                        <strong>{{Str::limit($item->productVariant->product->name,50)}}</strong>
                                        <p>{{Str::upper($item->productVariant->product_color->name)}}
                                            | {{$item->productVariant->product_size->name}}</p>
                                        <div class="d-flex justify-content-between">
                                            <p>x{{$item->quantity}}</p>
                                            <p>{{number_format($item->productVariant->price * $item->quantity)}}đ</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <input type="hidden" name="cart_id[]" value="{{$item->id}}">
{{--                            <input type="hidden" name="product_variant_id[]" value="{{$item->productVariant->id}}">--}}
                            @php($totalPrice += $item->productVariant->price * $item->quantity)
                        @endforeach
                    </table>
                    <form action="{{route('client.payment')}}" method="post">
                        @csrf
                        <strong>Mã Giảm Giá</strong>
                        <div class="d-flex mt-2 justify-content-between">
                            <div class="form-group mb-2">
                                <select class="custom-select" name="voucher" style="width: 330px">
                                    <option value="0" hidden>Nhập mã giảm giá</option>
                                    @foreach($userDetail->vouchers as $voucher)
                                        <option value="{{$voucher->id}}"
                                                @selected(session('voucher') == $voucher->id)
                                        >{{$voucher->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="total_applyVoucher" value="{{$totalPrice}}">
                            <button type="submit" class="btn btn-primary mb-2" name="applyVoucher" value="1">
                                Áp Dụng
                            </button>
                        </div>
                    </form>
                    <div class="">
                        <div class="d-flex mt-3 justify-content-between align-items-center">
                            <h5>Tổng Tiền: </h5>
                            <span>{{number_format($totalPrice)}}đ</span>
                        </div>
                        <div class="d-flex mt-3 justify-content-between align-items-center">
                            <h5>Mã Giảm Giá:</h5>
                            @if(session('discount'))
                                <span>-{{number_format(session('discount'))}}đ</span>
                            @else
                                <span>-0đ</span>
                            @endif
                        </div>
                        <div class="d-flex mt-3 justify-content-between align-items-center">
                            <h5>Thành Tiền: </h5>
                            @if(session('totalPrice'))
                                <span>{{number_format(session('totalPrice'))}}đ</span>
                                <input type="hidden" name="total_price" value="{{session('totalPrice')}}">
                            @else
                                <span>{{number_format($totalPrice)}}đ</span>
                                <input type="hidden" name="total_price" value="{{$totalPrice}}">
                            @endif
                        </div>

                    </div>
                    <div class="text-center mt-4 border-top pt-3">
                        <input type="hidden" name="product_name">
                        <input type="hidden" name="product_sku">
                        <input type="hidden" name="product_img_thumbnail">
                        <input type="hidden" name="product_price_regular">
                        <input type="hidden" name="product_price_sale">
                        <input type="hidden" name="quantity">
                        <input type="hidden" name="variant_color_name">
                        <input type="hidden" name="variant_size_name">
                        <input type="hidden" name="">
                        <button type="submit" class="btn btn-outline-success" value="1" name="paymentSuccess">
                            Thanh Toán
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
@section('title')
    Thanh Toán Đơn Hàng
@endsection
@section('lib-script')

@endsection

@section('lib-style')

@endsection
