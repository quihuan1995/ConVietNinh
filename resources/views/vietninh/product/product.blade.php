@extends('vietninh.home')
@section('title','Product')
@section('product')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="Productmanagement"class="tabContent" style="padding: 0;border: none;">
        <div class="head-order" >
            <div id="order-span" >
                <span >Danh sách sản phẩm</span>
            </div>
            <div id="add-order" >
                <a class="btn btn-primary" href="/home/product/add" role="button" ><b>Thêm sản phẩm</b></a>
            </div>
        </div>
                @if (session('thongbao'))
                <div class="alert bg-success" role="alert" style="color: #fff">
                <i class="far fa-check-circle"></i> <span>{{session('thongbao')}}</span>
                </div>
                @endif
            <form method="GET" action="/home/product/search">
                <div class="filter-form mb-2">
                    <nav class="navbar navbar-expand">
                        <ul class="navbar-nav row filter-ul">
                            <li class="nav-item filter-li" id="code-orders" style="margin-left:14px;">
                                <p class="filter-title">Mã sản phẩm</p>
                                <input type="text" name="menu_id" class="filter-input" placeholder="Nhập mã" style="width:63%;">
                            </li>
                            <li class="nav-item filter-li" id="customer-name" style="margin-right: 94px;margin-left: -30px;">
                                <p class="filter-title">Tên sản phẩm</p>
                                <input type="text" name="name_product" class="filter-input" placeholder="Nhập tên sp" style="width:125%;">
                            </li>
                            <li class="nav-item filter-li" id="customer-name" style="margin-right: 70px;">
                                <p class="filter-title">Giá sản phẩm</p>
                                <select name="start" class="filter-input" >
                                    <option >Chọn giá từ</option>
                                    <option value="1000000">1.000.000</option>
                                    <option value="4000000">4.000.000</option>
                                    <option value="8000000">8.000.000</option>
                                    <option value="12000000">12.000.000</option>
                                    <option value="15000000">15.000.000</option>
                                </select>
                                <select name="end" class="filter-input">
                                    <option >Chọn giá đến</option>
                                    <option value="17000000">17.000.000</option>
                                    <option value="20000000">20.000.000</option>
                                    <option value="24000000">24.000.000</option>
                                    <option value="27000000">27.000.000</option>
                                    <option value="32000000">32.000.000</option>
                                </select>
                            </li>
                            <li class="nav-item filter-li" id="customer-name">
                                <p class="filter-title">Trạng thái</p>
                                <select name="active" class="filter-input">
                                    <option>Chọn trạng thái</option>
                                    <option value="1">Còn Hàng</option>
                                    <option value="2">Hết Hàng</option>
                                </select>
                            </li>
                        </ul>
                    </nav>
                </div>
                <button id="search-prd" type="submit" >
                    <img src="./image/Icon-ionic-ios-search.svg" />
                </button>
        </form>
        <div class="table-neworder" id="table-data" >
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><b>Mã SP <SPan></SPan> <img src="./image/arrow-sort.svg" /></b></th>
                    <th><b>Hình ảnh</b></th>
                    <th><b>Tên sản phẩm</b></th>
                    <th><b>Giá Sản Phẩm</b></th>
                    <th><b>Số Lượng</b></th>
                    <th><b>Trạng thái</b></th>
                    <th><b>ACTION</b></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($products as $row)
                <tr>
                    <td>{{ $row->menu_id }}</td>
                    <td><img src="./image/product/{{ $row->images_product }}" class="img-prd" /></td>
                    <td>{{ $row->name_product }}</td>
                    <td>{{ number_format($row->price_product,0,'','.') }} đ</td>
                    <td>{{ $row->quantity }}</td>
                    <td>
                        @if ($row->active==1)
                        <button class="btn btn-success" role="button" style="border-radius: 50px;">Còn hàng</button>
                        @else
                        <button class="btn btn-danger"  role="button" style="border-radius: 50px;">Het hàng</button>
                        @endif
                    </td>
                    <td style="display: flex">
                        <a href="/home/product/edit/{{ $row->id }}" class="btn btn-link" style="color: #33ACFF;">Edit</a>
                        <a onclick="return del()" href="/home/product/delete/{{ $row->id }}" class="btn btn-link" style="color: red;">Delete</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            <div align='right'>
                {{ $products->links() }}
			</div>
        </div>
</div>

@endsection
@section('script')
    @parent
    <script>
        function del(){
        return confirm("Có muốn xóa San Pham này ko ?")
    }
    </script>
@endsection
