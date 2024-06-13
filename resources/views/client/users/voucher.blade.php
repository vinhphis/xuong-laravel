@extends('client.layouts.master')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <section class="section" id="men" style="margin-top: 20px">
        <div class="container">
            <form action="{{route('client.user.addVoucher')}}" method="post"
                  class="d-flex justify-content-center mt-4 mb-4">
                @csrf
                <div class="">
                    <input type="text" class="form-control" placeholder="Nhập mã giảm giá của bạn" name="name">

                </div>
                @error('name')
                <span class="invalid-feedback" role="alert">
                           <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit" class="btn btn-primary mx-3">Lưu mã</button>
            </form>

            <div class="row">
                @foreach($userVoucher->vouchers as $item)
                    <div class="col-sm-6 mt-2">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{$item->name}}</h5>
                                <p class="card-text">
                                    Giảm {{$item->type === 'fixed_price' ? number_format($item->discount).'đ' : $item->discount.'%'}}
                                    cho đơn hàng từ {{number_format($item->min_price)}}đ
                                </p>
                                <p class="card-text">
                                    Tối Đa <strong>{{number_format($item->total)}}đ</strong>
                                </p>
                                <a href="#" class="btn btn-primary">Chi Tiết</a>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>

        </div>
    </section>
@endsection
@section('title')
    Kho mã giảm giá
@endsection
@section('lib-script')

@endsection

@section('lib-style')

@endsection
