@extends('vietninh.home')
@section('title','User')
@section('userd')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="usermanagement"class="tabContent" style="padding: 0;border: none;">
    <div class="head-order" >
        <div id="order-span" >
            <span >Tài Khoản D</span>
        </div>
        <div id="add-order" >
            <a class="btn btn-primary" href="/home/user/add-d" role="button" ><b>Tạo tài khoản D</b></a>
        </div>
    </div>
    @if (session('thongbao2'))
    <div class="alert bg-success" role="alert" style="color: #fff">
    <i class="far fa-check-circle"></i> <span>{{session('thongbao2')}}</span>
    </div>
    @endif
    <form method="GET" action="/home/user/search_d">
     <div class="filter-form mb-2">
        <nav class="navbar navbar-expand">
            <ul class="navbar-nav row filter-ul">
                <li class="nav-item filter-li" id="code-orders" >
                    <p class="filter-title">Mã User</p>
                    <input type="text" name="user_id_d" class="filter-input" placeholder="Nhập mã" style="width:40%;">
                </li>
                <li class="nav-item filter-li" id="customer-name" style="margin-left: -93px;">
                    <p class="filter-title">Tên nhân viên</p>
                    <input type="text" name="named" class="filter-input" placeholder="Nhập tên" style="width:90%;">
                </li>
                <li class="nav-item filter-li" id="phone-number" style="margin-right: -52px;">
                    <p class="filter-title">SĐT</p>
                    <input type="text" name="phoned" class="filter-input" placeholder="Nhập SĐT" style="width:60%;">
                </li>
                <li class="nav-item filter-li" id="address" style="margin-left:-10px;margin-right:20px;">
                    <p class="filter-title">Địa chỉ</p>
                    <input type="text" name="addressd" class="filter-input" placeholder="Nhập địa chỉ">
                </li>
                <li class="nav-item filter-li" style="margin-right: 10px;">
                    <p class="filter-title">Thời gian vào công ty</p>
                    <input type="date" name="date_ind" class="filter-input" value="Chọn thời gian vao" style="color: black;">
                </li>
                <li class="nav-item filter-li" style="margin-right: 10px;">
                    <p class="filter-title">Thời gian nghỉ việc</p>
                    <input type="date" name="date_outd" class="filter-input" value="Chọn thời gian kết thúc" style="color: black;">
                </li>
                <li class="nav-item filter-li" id="status">
                    <p class="filter-title">Trạng thái</p>
                    <select name="stated" class="filter-input">
                        <option>Chọn trạng thái</option>
                        <option value="1">Vẫn làm </option>
                        <option value="2">Đã Nghỉ</option>
                    </select>
                </li>
            </ul>
        </nav>
    </div>
    <button id="search-use" type="submit" >
        <img src="./image/Icon-ionic-ios-search.svg" />
    </button>
    </form>
    <div class="table-neworder" >
        <table class="table table-hover">
            <thead>
            <tr>
                <th><b>MÃ <img src="./image/arrow-sort.svg" /></b></th>
                <th><b>TÊN NHÂN VIÊN</b></th>
                <th><b>SDT</b></th>
                <th><b>ĐỊA CHỈ</b></th>
                <th><b>TRẠNG THÁI</b></th>
                <th><b>NGÀY VÀO</b></th>
                <th><b>NGÀY NGHỈ</b></th>
                <th><b>ACTION</b></th>

            </tr>
            </thead>
            <tbody>
                @foreach ($userd as $row)
                <tr>
                <td>{{ $row->user_id_d }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->phone }}</td>
                <td>{{ $row->address }}</td>
                <td>
                    @if($row->state == 1)
                        <a name="" id="success-customer" class="btn btn-success"  role="button" >Vẫn làm</a>
                    @else
                        <a name="" id="success-customer" class="btn btn-danger"  role="button" >đã nghỉ</a>
                    @endif
                </td>
                <td>{{ $row->date_in }}</td>
                <td>{{ $row->date_out }}</td>
                <td style="display: flex">
                    <a href="/home/user/edit-c/{{ $row->id }}" class="btn btn-link" style="color: #33ACFF;">Edit</a>
                    <a onclick="return del()" href="/home/user/delete-c/{{ $row->id }}" class="btn btn-link" style="color: red;">Delete</a>
                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        	<div align='right'>
			{{$userd->links()}}
			</div>
    </div>
</div>
@endsection
@section('script')
    @parent
    <script>
        function del(){
           return confirm("Có muốn xóa Tài khoản này ko ?")
    }
    </script>
@endsection

