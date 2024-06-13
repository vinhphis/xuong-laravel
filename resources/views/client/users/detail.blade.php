@extends('client.layouts.master')

@section('content')
    <section class="section" id="men" style="margin-top: 20px">
        <div class="container">
            <form>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="hoTen" class="form-label">Họ tên</label>
                        <input type="text" class="form-control" id="hoTen" value="{{$user->name}}">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" value="{{$user->email}}">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="soDienThoai" class="form-label">Số Điện Thoại</label>
                    <input type="number" class="form-control" id="soDienThoai">
                </div>
                <div class="mb-3">
                    <label for="diaChi" class="form-label">Địa Chỉ</label>
                    <input type="text" class="form-control" id="diaChi">
                </div>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </form>
        </div>
    </section>
@endsection
@section('title')
    Thông tin người dùng
@endsection
@section('lib-script')

@endsection

@section('lib-style')

@endsection
