@extends('vietninh.home')
@section('title','Order')
@section('order')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="oderScreen"class="tabContent" style="padding: 0;border: none;">
        <div class="head-order" >
            <div id="order-span" >
                <span >Đơn Hàng</span>
            </div>
            <div id="add-order" >
                <a class="btn btn-primary" href="/home/order/add" role="button" ><b>Tạo đơn hàng</b></a>
            </div>
        </div>
            @if (session('thongbao'))
                <div class="alert bg-success" role="alert" style="color: #fff">
                    <i class="far fa-check-circle"></i> <span>{{session('thongbao')}}</span>
                </div>
            @endif
            @if (session('thongbao1'))
                <div class="alert bg-warning" role="alert" style="color: #fff">
                    <i class="far fa-check-circle"></i> <span>{{session('thongbao1')}}</span>
                </div>
            @endif
    <form method="get" action="/home/order/search">
        <div class="filter-form mb-2">
			<nav class="navbar navbar-expand">
			    <ul class="navbar-nav row filter-ul">
			        <li class="nav-item filter-li" id="code-orders" style="margin-left:14px;">
			        	<p class="filter-title">Mã đơn hàng</p>
			        	<input type="text" name="id" class="filter-input" placeholder="Nhập mã" style="width:63%;">
			        </li>
			        <li class="nav-item filter-li" id="customer-name" style="margin-right: -1px;margin-left: -59px;">
			        	<p class="filter-title">Tên khách hàng</p>
			        	<input type="text" name="name" class="filter-input" placeholder="Nhập tên khách hàng" style="width:90%;">
			        </li>
			        <li class="nav-item filter-li" id="phone-number" style="margin-right: -64px;">
			        	<p class="filter-title">SĐT</p>
			        	<input type="text" name="phoner" class="filter-input" placeholder="Nhập SĐT" style="width:60%;">
			        </li>
			        <li class="nav-item filter-li" id="address" style="margin-left:-6px;margin-right:6px;">
			        	<p class="filter-title">Địa chỉ</p>
			        	<input type="text" name="addrees" class="filter-input" placeholder="Nhập địa chỉ">
			        </li>
			        <li class="nav-item filter-li"  style="margin-right: 10px;">
			        	<p class="filter-title">Thời gian thi công</p>
			        	<input type="date" name="order_start_date" class="filter-input" value="Chọn thời gian thi công" style="color: black;">
			        </li>
			        <li class="nav-item filter-li" style="margin-right: 10px;">
			        	<p class="filter-title">Thời gian kết thúc</p>
			        	<input type="date" name="order_complete_date" class="filter-input" value="Chọn thời gian kết thúc" style="color: black;">
			        </li>
			        <li class="nav-item filter-li" id="status">
			        	<p class="filter-title">Trạng thái</p>
			        	<select name="state" class="filter-input">
			        		<option >Chọn trạng thái</option>
			        		<option value="1">Chưa xử lý</option>
			        		<option value="2">Đang thi Công</option>
			        		<option value="3">Hoàn Thành</option>
			        	</select>
			        </li>
			    </ul>
			</nav>
        </div>
        <button id="search-or" type="submit" >
                <img src="./image/Icon-ionic-ios-search.svg" />
        </button>
    </form>
        <div class="table-neworder" >
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><b>Mã ĐƠN <img src="./image/arrow-sort.svg" /></b></th>
                    <th><b>TÊN KHÁCH HÀNG</b></th>
                    <th><b>SDT</b></th>
                    <th><b>ĐỊA CHỈ</b></th>
                    <th><b>THI CÔNG</b></th>
                    <th><b>KẾT THÚC</b></th>
                    <th><b>TRẠNG THÁI</b></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($customer as $row)
                <tr>
                    @foreach ($row->order as $item)
                        <td>{{ $item->id }}</td>
                    @endforeach

                    <td>{{ $row->name }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->addrees }}</td>
                    <td>{{ $row->order_start_date }}</td>
                    <td>{{ $row->order_complete_date }}</td>
                    <td>
                    @foreach ($row->order as $item)
                        @if ( $item->order_status==2 )
                            <a href="/home/order/success/{{ $row->id }}" id="success-order" class="btn btn-success"  role="button" >đã hoàn thành</a></td>
                        @elseif($item->order_status==1 )
                            <a href="/home/order/deliver/{{ $row->id }}" id="success-order" class="btn btn-warning" style="color: black"  role="button" >đang thi công</a></td>
                        @else
                            <a href="/home/order/detail/{{ $row->id }}" id="work-order" class="btn" ><b>chưa xử lý</b></a></td>
                        @endif
                    @endforeach

                </tr>
                @endforeach
                </tbody>
            </table>
            <div align='right'>
            {{ $customer->links() }}
			</div>
        </div>
</div>
@endsection
