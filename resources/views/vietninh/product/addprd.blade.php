@extends('vietninh.home')
@section('title','Add Product')
@section('product')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="AddPrdmanagement"class="tabContent" style="padding: 0;border: none;">
        <div class="head-order" >
            <div id="order-span" >
                <span >Danh sách sản phẩm</span>
            </div>
        </div>
<div class="add-product">
    <form method="post" enctype="multipart/form-data" action="/home/product/add">
        @csrf
        <button type="submit" class="btn btn-primary" id="save-product">Luu san pham</button>
        <div class="img-product">
            <h3><b>Ảnh sản phẩm</b></h3>
            <div class="add-img-prd" style="padding:55px">
                <input id="images_product" type="file" name="images_product" class="form-control hidden" style="display: none" onchange="changeImg(this)">
                <img id="avatar" class="thumbnail"src="./image/icon-add.svg" >
            </div>
        </div>
        <div class="information-product">
            <div class="filter-form mb-2">
			<nav class="navbar navbar-expand">
                <h2 class="h-sale"><b>Thông tin chung</b></h2>
			    <ul class="navbar-nav row filter-ul">
			        <li class="nav-item filter-li" id="customer-name" >
			        	<p class="filter-title">Tên sản phẩm</p>
			        	<input type="text" name="name_product" class="filter-input" placeholder="Nhập tên sp" style="width:120%;background-color: #F0F0F0;">
                         {{showErrors($errors,'name_product')}}
                    </li>
                    <li class="nav-item filter-li" id="code-orders" style="margin-left:124px">
			        	<p class="filter-title">Số Lượng</p>
			        	<input type="text" name="quantity" class="filter-input" placeholder="Nhập SL" style="width:85%;background-color: #F0F0F0;">
                          {{showErrors($errors,'quantity')}}
                    </li>
			        <li class="nav-item filter-li" id="status">
			        	<p class="filter-title">Loại sản phẩm</p>
			        	<select name="type_product" class="filter-input" style="width: 120%;background-color: #F0F0F0;">
			        		<option >Chọn Danh Mục</option>
			        			 {{ GetCate($category,0,"",0) }}
			        	</select>
                    </li>
                    <li class="nav-item filter-li" id="code-orders" style="margin-left:121px;">
			        	<p class="filter-title">Giá sản phẩm</p>
			        	<input type="text" name="price_product" class="filter-input" placeholder="Nhập giá" style="width:85%;background-color: #F0F0F0;">
                          {{showErrors($errors,'price_product')}}
                    </li>
                    <li class="nav-item filter-li" id="code-orders">
			        	<p class="filter-title">Kiểu sản phẩm</p>
                        <select name="sku" class="filter-input" style="width:110%;background-color: #F0F0F0;">
                            <option >Chọn Kiểu Sản Phẩm</option>
			        		<option value="0">Smart Phone</option>
			        		<option value="1">Normal Phone </option>
                        </select>
                    </li>
                    <li class="nav-item filter-li" id="code-orders" style="margin-left:19%">
			        	<p class="filter-title">Mã SP</p>
			        	<input type="text" name="menu_id" class="filter-input" placeholder="Nhập mã" style="width:85%;background-color: #F0F0F0;">
                          {{showErrors($errors,'menu_id')}}
                    </li>
			    </ul>
			</nav>
		    </div>
        </div>
    <div class="product-sale">
        <div class="filter-form1 mb-2" >
			<nav class="navbar navbar-expand">
                <h3 class="h-sale"><b>Khuyến mại</b></h3>
			    <ul class="navbar-nav row filter-ul">
			        <li class="nav-item filter-li" id="customer-name" style="margin-right: 1px;margin-left: 6px;">
			        	<p class="filter-title">Giá khuyến mại</p>
			        	<input type="text" name="price_product_sale" class="filter-input" id="price_product_sale" placeholder="Nhập tên gia" >
                          {{showErrors($errors,'price_product_sale')}}
                    </li>
                    <li class="nav-item filter-li" id="customer-name" style="margin-right: 1px;margin-left: 50px;">
			        	<p class="filter-title">Tình trạng</p>
			        	<select name="active" class="filter-input" style="width:190%;background-color: #F0F0F0;">
                            <option >Tình trạng</option>
                            <option value="1">Còn hàng</option>
                            <option value="2">Het hàng</option>
                        </select>
                    </li>
                    <li class="nav-item filter-li"   style="margin-right: 85px;margin-left:6px;margin-top: 10px;">
			        	<p class="filter-title">Khuyến mại từ</p>
                        <input id="date" type="date" name="start_discount" class="filter-input" value="2018-06-12t19:20" >
                          {{showErrors($errors,'start_discount')}}
                    </li>

			        <li class="nav-item filter-li"  style="margin-right: 10px;margin-top: 10px;">
			        	<p class="filter-title">Khuyến mại đến</p>
                        <input id="date" type="date" name="stop_discount" class="filter-input" value="2018-06-12t19:20"  >
                          {{showErrors($errors,'stop_discount')}}
                    </li>

			    </ul>
			</nav>
		</div>
    </div>
        <div class="detail-product">
            <h3><b>Chi tiết sản phẩm</b></h3>
            <textarea class="ckeditor" name="content"></textarea>
              {{showErrors($errors,'content')}}
        </div>
    </form>
    <div class="history">
        <table class="table table-hover">
            <h2 style="display:inline-block;margin-right:-12%;"><b>Lịch sử xuất nhập</b></h2>
            <a href="/home/product/history" class="btn btn-primary" style="margin-left:70%;border-radius: 23px;">
                <b>+ Thêm Lịch sử</b>
            </a>
            <thead>
            <tr>
                <th><b>Ngày Tháng <img src="./image/arrow-sort.svg" /> </b></th>
                <th><b>Nhập/Xuất</b></th>
                <th><b>SL</b></th>
                <th><b>đơn giá</b></th>
                <th><b>Thành tiền</b></th>
            </tr>
            </thead>
            <tbody>
                @foreach ($history as $row)
                <tr>
                    <td>{{ $row->histories }}</td>
                    <td>
                        @if ( $row->ImExPort == 1 )
                            Nhập
                        @else
                            Xuất
                        @endif
                    </td>
                    <td>{{ $row->quantity }}</td>
                    <td>{{ number_format($row->price,0,'','.') }} đ</td>
                    <td>{{ number_format($row->total_price,0,'','.') }} đ</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
</div>

@endsection
@section('script')
    @parent
    <script>
    function changeImg(input){
		    //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
		    if(input.files && input.files[0]){
		        var reader = new FileReader();
		        //Sự kiện file đã được load vào website
		        reader.onload = function(e){
		            //Thay đổi đường dẫn ảnh
		            $('#avatar').attr('src',e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$(document).ready(function() {
		    $('#avatar').click(function(){
		        $('#images_product').click();
		    });
		});

    </script>
@endsection
