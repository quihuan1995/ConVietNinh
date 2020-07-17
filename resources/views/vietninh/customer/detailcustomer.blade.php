@extends('vietninh.home')
@section('title','Detail Customer')
@section('customer')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="DetailCustomermanagement"class="tabContent" style="padding: 0;border: none;">
    <div class="head-order" >
        <div id="order-span" >
            <span >Thông Tin Khách Hàng</span>
        </div>
        <div id="add-order" >
            <a class="btn btn-primary" href="#" role="button" style="left: -233px;" ><b>Quay lai</b></a>
        </div>
    </div>
    <div id="main-order-work">
        <div id="userb-time">
            <div class="name-userb">
                    <img src="./image/customer/{{ $customer->img_customer }}" class="img-userb" />
                <p><img src="./image/Icon feather-user.svg" style="margin-right: 15px;" /><b>{{ $customer->name }}</b></p>
                <p><img src="./image/icon-phone.svg" style="margin-right: 15px;" />{{ $customer->phone }}</p>
            </div>
            <div class="work-userb">
                <img src="./image/icon-marker.svg" style="float: left; margin-left: 1%;margin-top: 2%;" /><p class="address-userb">{{ $customer->addrees}}</p>
            </div>
        </div>
        <div class="table-product" >
            <h2 style="display:inline-block;margin-right:-12%;"><b>Danh Sách đơn hàng</b></h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><b>Mã </b></th>
                    <th><b>Sản phẩm</b></th>
                    <th><b>Ảnh Sản phẩm</b></th>
                    <th><b>Thành tiền</b></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($customer->order as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->name }}</td>
                            <td><img src="./image/product/{{ $row->img }}" style="width:50px" /></td>
                            <td>{{ $row->total }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="all-order-customer">
            <h3><b>Tổng số đơn hàng</b></h3>
                <h1>{{ $customer->count('id') }}</h1>
        </div>

        <div class="all-money-customer">
            <h3>Tong Tien:</h4>
            <h1>{{ number_format($customer->total,0,'','.') }} VND</h1>
        </div>
    </div>
</div>



@endsection
