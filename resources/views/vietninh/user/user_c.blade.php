@extends('vietninh.home')
@section('title','User')
@section('userc')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="usermanagement"class="tabContent" style="padding: 0;border: none;">
    <div class="head-order" >
        <div id="order-span" >
            <span >Tài Khoản C</span>
        </div>
        <div id="add-order" >
            <a class="btn btn-primary" href="/home/user/add-c" role="button" ><b>Tạo tài khoản C</b></a>
        </div>
    </div>
                        @if (session('thongbao1'))
                        <div class="alert bg-success" role="alert" style="color: #fff">
                        <i class="far fa-check-circle"></i> <span>{{session('thongbao1')}}</span>
                        </div>
                        @endif
    <form method="GET" action="/home/user/search_c">
    <div class="filter-form mb-2">
        <nav class="navbar navbar-expand">
            <ul class="navbar-nav row filter-ul">
                <li class="nav-item filter-li" id="code-orders" >
                    <p class="filter-title">Mã User</p>
                    <input type="text" name="user_id_c" class="filter-input" placeholder="Nhập mã" style="width:40%;">
                </li>
                <li class="nav-item filter-li" id="customer-name" style="margin-left: -93px;">
                    <p class="filter-title">Tên nhân viên</p>
                    <input type="text" name="namec" class="filter-input" placeholder="Nhập tên" style="width:90%;">
                </li>
                <li class="nav-item filter-li" id="phone-number" style="margin-right: -52px;">
                    <p class="filter-title">SĐT</p>
                    <input type="text" name="phonec" class="filter-input" placeholder="Nhập SĐT" style="width:60%;">
                </li>
                <li class="nav-item filter-li" id="address" style="margin-left:-10px;margin-right:20px;">
                    <p class="filter-title">Địa chỉ</p>
                    <input type="text" name="addressc" class="filter-input" placeholder="Nhập địa chỉ">
                </li>
                <li class="nav-item filter-li"   style="margin-right: 10px;">
                    <p class="filter-title">Thời gian vào công ty</p>
                    <input type="date" name="date_inc" class="filter-input" value="Chọn thời gian vao" style="color: black;">
                </li>
                <li class="nav-item filter-li"  style="margin-right: 10px;">
                    <p class="filter-title">Thời gian nghỉ việc</p>
                    <input type="date" name="date_outc" class="filter-input" value="Chọn thời gian kết thúc" style="color: black;">
                </li>
                <li class="nav-item filter-li" id="status">
                    <p class="filter-title">Trạng thái</p>
                    <select name="statec" class="filter-input">
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
                @foreach ($userc as $row)
                <tr>
                <td>{{ $row->user_id_c }}</td>
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
			{{$userc->links()}}
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

