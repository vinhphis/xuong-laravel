@extends('client.layouts.master')

@section('content')
    <section class="section" id="men" style="margin-top: 20px">
        <div class="container">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Số Điện Thoại</th>
                    <th scope="col">Email</th>
                    <th scope="col">Địa Chỉ</th>
                    <th scope="col">Thanh Toán</th>
                    <th scope="col">Trạng Thái Đơn Hàng</th>
                    <th scope="col">Tổng Tiền</th>
                    {{--                                        <th scope="col">Trạng Thái Thanh Toán</th>--}}
                    <th scope="col">Tác Vụ</th>
                </tr>
                </thead>
                <tbody>
                @forelse($orderUser as $order)
                    {{--                    @dd($order)--}}
                    <tr>
                        <th scope="row">{{$loop->iteration}}</th>
                        <td>{{$order->user_name}}</td>
                        <td>{{$order->user_phone}}</td>
                        <td>{{ $order->user_email }}</td>
                        <td>{{$order->user_address}}</td>
                        <td>{{$order->payment == 'delivery' ? 'Thanh toán khi nhận hàng' : 'Thanh toán Online'}}</td>

                        <td>
                            @foreach(\App\Models\Orders::STATUS_ORDER as $item)
                                @if($item['key'] === $order->status_order)
                                    <span>{{$item['value']}}</span>
                                @endif
                            @endforeach
                        </td>
                        <td>{{number_format($order->total_price)}}đ</td>
                        <td>
                            <a class="btn btn-secondary" href="{{route('client.orderItem',$order->id)}}">Chi Tiết</a>
                            @if($order->status_order === \App\Models\Orders::STATUS_ORDER_CANCELED
                                || $order->status_order === \App\Models\Orders::STATUS_ORDER_SHIPPING)

                            @elseif($order->status_order === \App\Models\Orders::STATUS_ORDER_DELIVERED)
                                <a class="btn btn-warning mt-2" href="">Hoàn Đơn</a>
                            @else
                                <a class="btn btn-danger mt-2" href="{{route('client.orderCanceled',$order->id)}}"
                                   onclick="return confirm('Bạn có muốn hủy đơn này không?')">Hủy đơn</a>
                            @endif

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center mt-3"><h4>Bạn chưa có đơn hàng nào</h4></td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
@section('title')
    Đơn Hàng
@endsection
@section('lib-script')

@endsection

@section('lib-style')

@endsection
