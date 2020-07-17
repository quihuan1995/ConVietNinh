@extends('vietninh.home')
@section('title','Success Order')
@section('order')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
 <div id="detailOrder"class="tabContent" style="padding: 0;border: none;">
        <div class="head-order" >
            <div id="order-span" >
                <span >Đơn Hàng: @foreach($customer->order as $row)
                    {{ $row->id }}
                @endforeach</span>
            </div>
            <div id="add-order" >
                <button class="btn btn-success"  role="button" ><i class="far fa-check-circle"></i> <b>Đã hoàn thành</b></button>
                <a class="btn btn-link" href="/home/order" role="button" style="background-color: #fff" ><b>Quay Lại</b></a>
            </div>
        </div>
        <div id="main-order-work">
            <div id="userb-time">
                <div class="name-userb">
                        <img src="./image/image-Logo.png" class="img-userb" />
                    <p><img src="./image/Icon feather-user.svg" style="margin-right: 15px;" /><b>{{ $customer->name }}</b></p>
                    <p><img src="./image/icon-phone.svg" style="margin-right: 15px;" />{{ $customer->phone}}</p>
                </div>
                <div class="work-userb">
                    <img src="./image/icon-marker.svg" style="float: left; margin-left: 1%;margin-top: 2%;" /><p class="address-userb">{{ $row->addrees }}</p>
                    @foreach ($customer->order as $row)
                            <p><img src="./image/icon-time.svg" style="margin-right: 15px;" />Thời gian thi công:<br><span>{{ $row->order_start_date }}</span></p>
                    <p><img src="./image/icon-time.svg" style="margin-right: 15px;" />Thời gian kết thúc:<br><span>{{ $row->order_complete_date }}</span></p>
                    @endforeach

                </div>
            </div>
            <div class="table-product" style="top: 319px;width: 795px;" >
                <h2 style="display:inline-block;margin-right:-12%;"><b>Danh Sách Sản phẩm</b></h2>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><b>Mã</b></th>
                        <th><b>Ảnh sản phẩm</b></th>
                        <th><b>Tên Sản Phẩm</b></th>
                        <th><b>SL</b></th>
                        <th><b>đơn giá</b></th>
                        <th><b>Thành tiền</b></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($customer->order as $row)
                        <tr>
                                <td>{{ $row->id }}</td>
                                <td><img src="./image/product/{{$row->img}}" class="img-prd"/></td>
                                <td>{{ $row->name }}</td>
                                <td>{{$row->total_price_construction}}</td>
                                <td>{{ number_format($row->total,0,'','.') }} </td>
                                <td>{{ number_format($row->total_price,0,'','.') }} </td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        <div class="admin-c">
        @foreach($customer->order as $row)
        <select id="select-userorder" name="user_id" class="filter-input">
            <option value="0" data-left="./image/image-Logo.png">Quản lý A</option>
            {{ GetUserA($user,$row->user_id) }}
        </select>
        <select id="select-userorder" name="user_id_b" class="filter-input"><img src="./image/image-Logo.png" />
            <option value="0">Quản lý B</option>
            {{ GetUserB($userb,$row->user_id_b) }}
        </select>
        <select id="select-userorder" name="user_id_c" class="filter-input"><img src="./image/image-Logo.png" />
            <option value="0">Quản lý C</option>
        {{ GetUserC($userc,$row->user_id_c) }}
        </select>
        @endforeach
    </div>

        <div class="order-work">
                <h3>Người Thi Công</h3>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><b>ẢNH ĐẠI DIỆN </b></th>
                        <th><b>MÃ</b></th>
                        <th><b>HỌ VÀ TÊN</b></th>
                        <th><b>SDT</b></th>

                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($userd as $row)
                        <tr>
                        <td> <img src="./image/user/{{ $row->avatar }}" /></td>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->phone }}</td>
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
            <div class="all-money" style="width: 62%;top: 157px;left: 462px;">
                <h4>Tong Tien:</h4>
                <h1>{{ number_format($customer->total,0,'','.') }} VND</h1>
            </div>
        </div>
</div>
@endsection
