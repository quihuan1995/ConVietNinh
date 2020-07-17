<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <!-- Fonts -->
        <base href="{{asset('').'vietninh/'}}">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
        <link rel="stylesheet" href="font-awesome/css/all.css">
        <link rel="stylesheet" href="font-awesome/css/fontawesome.css">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row" style="background-color: #EEF4F9;">
                <div class="col-md-2 col-lg-2 " style="padding: 36px">
                    <div class="slide-menu"  >
                        <div id="logo"  >
                            <img src="./image/vietninh.png"  />
                            </div>
                        <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
                            <ul class="list-group">
                                <li><a href="/home/dashboard" @yield('dashboard')  ><img src="./image/icon-dashboard.svg" class="imageicon"/>DashBoard</a></li>
                                <li><a href="/home/category" @yield('category')> <img src="./image/Icon feather-package.svg" class="imageicon" />Danh muc</a></li>
                                <li><a href="/home/product" @yield('product') > <img src="./image/Icon feather-package.svg" class="imageicon" />Sản phẩm</a></li>
                                <li><a href="/home/order" @yield('order')> <img src="./image/product.svg" class="imageicon"/>Đơn Hàng</a></li>
                                <li><a href="/home/customer"  @yield('customer') > <img src="./image/support.svg" class="imageicon"/>Quản lý khách hàng</a></li>
                                <li><a href="/home/user/user-c" @yield('userc')>  <img src="./image/Icon-awesome-users.svg" class="imageicon" /> Quản lý tài khoản C</a></li>
                                <li><a href="/home/user/user-d" @yield('userd')>  <img src="./image/Icon-awesome-users.svg" class="imageicon" /> Quản lý tài khoản D</a></li>
                            </ul>
                        </div>
                        <div class="user-menu">
                            <div class="user-logout">
                                <img src="./image/image-Logo.png" style="max-width:50px;max-height: 50px; border-radius:50%;object-fit:contain;"/>
                                <span>
                                    @if(Auth::check())
                                        {{Auth::user()->name}}
                                    @endif
                                </span>
                            </div>
                            <div class="the-drop"  role="menu">
                                <a onclick="return out()" href="/logout"><img src="./image/Icon feather-user.svg"><b>Đăng xuất</b></a>
                            </div>
                        </div>

                    </div>
                </div>

