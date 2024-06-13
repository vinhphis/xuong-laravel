@php
    $generate_navbar = [
                   [
                       'name_navbar' => 'Danh Mục Sản Phẩm',
                       'route_navbar' => 'admin.catelogues.index'
                   ],
                   [
                       'name_navbar' => 'Sản Phẩm',
                       'route_navbar' => 'admin.products.index'
                   ],
                   [
                       'name_navbar' => 'Khuyến Mại',
                       'route_navbar' => 'admin.vouchers.index'
                   ],
                   [
                       'name_navbar' => 'Đơn Hàng',
                       'route_navbar' => 'admin.orders.list'
                   ],
                   [
                       'name_navbar' => 'Banner Marketing',
                       'route_navbar' => 'admin.bannerMkts.index'
                   ],
                   [
                       'name_navbar' => 'Tài Khoản',
                       'route_navbar' => 'admin.users.index'
                   ],
                   [
                       'name_navbar' => 'Trang Người Dùng',
                       'route_navbar' => 'client.home'
                   ],
               ];
@endphp
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('gallerys/logo_web/logo_ca_nhan.png')}}" alt="" height="50">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('gallerys/logo_web/logo_ca_nhan.png')}}" alt="" height="100">
                    </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('gallerys/logo_web/logo_ca_nhan2.png')}}" alt="" height="50">
                    </span>
            <span class="logo-lg">
                        <img src="{{asset('gallerys/logo_web/logo_ca_nhan2.png')}}" alt="" height="100">
                    </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('admin.dashboard')}}">
                        <i class="ri-dashboard-2-line"></i>
                        <span data-key="t-dashboards">Trang Chủ</span>
                    </a>

                </li>

                @foreach($generate_navbar as $key => $val)
                    <li class="nav-item">
                        <a class="nav-link menu-link" href="{{route($val['route_navbar'])}}">
                            <i class="ri-layout-3-line"></i>
                            <span data-key="t-layouts">{{$val['name_navbar']}}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>
