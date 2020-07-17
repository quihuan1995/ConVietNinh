@extends('vietninh.home')
@section('title','Customer')
@section('customer')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="Customermanagement"class="tabContent" style="padding: 0;border: none;">
    <div class="head-order" >
        <div id="order-span" >
            <span >Quản Lý Khách Hàng</span>
        </div>
    </div>
    <form method="GET" action="/home/customer/search">
        <div class="filter-form mb-2">
			<nav class="navbar navbar-expand">
			    <ul class="navbar-nav row filter-ul">
			        <li class="nav-item filter-li" id="code-orders" style="margin-left:17px;">
			        	<p class="filter-title">Mã khách hàng</p>
			        	<input type="text" name="id" class="filter-input" placeholder="Nhập mã" style="width:63%;">
			        </li>
			        <li class="nav-item filter-li" id="customer-name" style="margin-right: 27px;margin-left: -18px;">
			        	<p class="filter-title">Tên khách hàng</p>
			        	<input type="text" name="name" class="filter-input" placeholder="Nhập tên khách hàng" style="width:100%;">
			        </li>
			        <li class="nav-item filter-li" id="phone-number" style="margin-right: -155px;">
			        	<p class="filter-title">SĐT</p>
			        	<input type="text" name="phone" class="filter-input" placeholder="Nhập SĐT" style="width:99%;">
			        </li>
			        <li class="nav-item filter-li" id="address" style="margin-left:180px;margin-right:51px;">
			        	<p class="filter-title">Địa chỉ</p>
			        	<input type="text" name="addrees" class="filter-input" placeholder="Nhập địa chỉ" style="width:120%">
			        </li>
			        <li class="nav-item filter-li" id="status">
			        	<p class="filter-title">Trạng thái</p>
			        	<select name="state" class="filter-input">
			        		<option>Chọn trạng thái</option>
                            <option value="1">chưa khóa</option>
                            <option value="3">khóa</option>
			        	</select>
			        </li>
			    </ul>
			</nav>
        </div>
        <button id="search-cus" type="submit" >
                <img src="./image/Icon-ionic-ios-search.svg" />
        </button>
    </form>
    <div class="table-neworder" >
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><b>Mã KH <img src="./image/arrow-sort.svg" /></b></th>
                    <th><b>TÊN KHÁCH HÀNG</b></th>
                    <th><b>SDT</b></th>
                    <th><b>ĐỊA CHỈ</b></th>
                    <th><b>THÔNG TIN</b></th>
                    <th><b>TRẠNG THÁI</b></th>
                </tr>
                </thead>
                <tbody>
                    @foreach($customer as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ $row->addrees }}</td>
                    <td><a href="/home/customer/detail/{{ $row->id }}" class="btn btn-link" style="color: #33ACFF;">Xem</a></td>
                    <td> @if($row->state==3)
                        <a name="" id="success-customer" class="btn btn-success"  role="button" ><img id="father-lock" src='./image/Icon-feather-lock.svg'/>khóa</a>
                        @else
                        <a name="" id="success-customer" class="btn btn-danger"  role="button" ><img id="father-lock" src='./image/Icon-feather-lock.svg'/>Chưa khóa</a>
                        @endif
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            <div align="right">
                {{ $customer->links() }}
            </div>
    </div>
</div>


@endsection
