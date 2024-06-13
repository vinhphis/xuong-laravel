@php
    $dataCatelogues = \App\Models\Catelogue::query()->orderByDesc('id')->get()->toArray();
@endphp
<div class="row">
    <div class="col-12">
        <nav class="main-nav">
            <!-- ***** Logo Start ***** -->
            <a href="{{route('client.home')}}" class="logo ml-5">
{{--                @dd(asset('gallerys/logo_web/logo_ca_nhan.png'))--}}
                <img src="{{asset('gallerys/logo_web/logo_ca_nhan.png')}}" alt="" width="100px">
            </a>
            <!-- ***** Logo End ***** -->
            <!-- ***** Menu Start ***** -->
            <ul class="nav mx-5">
                <li class="scroll-to-section"><a href="{{route('client.home')}}" class="active">Trang Chủ</a></li>
                <li class="scroll-to-section"><a href="#">Giới Thiệu</a></li>
                @foreach($dataCatelogues as $catelogue)
                    <li class="scroll-to-section">
                        <a href="{{route('client.productListCatelogue',$catelogue['id'])}}">{{$catelogue['name']}}</a>
                    </li>
                @endforeach

                @if(Auth::user())
                    <li class="submenu">
                        <a href="javascript:0">
                            <i class="fa-solid fa-user mx-1"></i>{{ Auth::user()->name }}
                        </a>
                        <ul>
                            <li><a href="{{route('client.user.detail')}}">Thông Tin</a></li>
                            <li><a href="{{route('client.user.voucher')}}">Mã Giảm Giá</a></li>
                            <li><a href="{{route('client.order')}}">Đơn Hàng</a></li>
                            <li><a href="{{route('client.logOut')}}">Đăng Xuất</a></li>
                        </ul>
                    </li>

                @else
                    <li class="scroll-to-section">
                        <a href="{{route('client.signIn')}}">Đăng Nhập/Đăng Ký</a>
                    </li>
                @endif

            </ul>
            <!-- ***** Menu End ***** -->
        </nav>
    </div>
</div>
@if(!request()->is('client/cart'))
    <div class="d-flex justify-content-end">
        <a href="{{route('client.cart')}}" class="text-dark" title="Giỏ Hàng">
            <i class="fa-solid fa-cart-shopping mt-3 mx-3" style="font-size: 25px"></i>
        </a>
    </div>
@endif

@if(session('msg') && session('status'))
    <div class="alert alert-{{session('status')}} alert-dismissible fade show col-3 float-right" role="alert"
         style="z-index: 100">

        <p>{{session('msg')}}</p>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
