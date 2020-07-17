@extends('vietninh.home')
@section('title','ADD Order')
@section('order')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="addOrder"class="tabContent" style="padding: 0;border: none;">
    <div class="head-order" >
        <div id="order-span" >
            <span >Tạo Đơn Hàng</span>
        </div>
        <div id="add-order" >
            <form method="POST" enctype="multipart/form-data">
            @csrf
            <button class="btn btn-primary" type="submit" role="button" style="border-radius: 23px;opacity: 1;" ><b>Lưu đơn hàng</b></button>
            <a class="btn btn-link" href="/home/order" role="button" style="background-color: #fff" ><b>Quay Lại</b></a>
        </div>
    </div>

    <div id="main-addorder">
        <div class="filter-form mb-2" id="creat-edit-user">
            <nav class="navbar navbar-expand">
                <ul class="navbar-nav row filter-ul" style="display: block;">
                <h3>Thông tin khách hàng</h3>
                    <li class="nav-item filter-li" id="customer-name" style="margin:5%;" >
                        <p class="filter-title"> <img src="./image/Icon feather-user.svg"> Ảnh đại diện</p>
                        <input id="img_customer" type="file" name="img_customer" class="form-control hidden" style="display:none" onchange="changeImg(this)">
                        <img id="img_cate" class="thumbnail"src="./image/icon-add.svg" style="width:30%;position:inherit;cursor: pointer;">
                    </li>
                    <li class="nav-item filter-li" id="customer-name" style="margin:5%;" >
                        <p class="filter-title">  <img src="./image/Icon feather-user.svg"> Tên khách hàng</p>
                        <input type="text" name="name" class="filter-input" placeholder="Nhập tên khách hàng" style="border-radius: 5px;opacity: 1;background-color:#F0F0F0;width:80%;">
                        {{showErrors($errors,'name')}}
                    </li>
                    <li class="nav-item filter-li" id="customer-name" style="margin:5%;" >
                        <p class="filter-title"> <img src="./image/Icon-feather-phone.svg"> SDT khách hàng</p>
                        <input type="text" name="phone" class="filter-input" placeholder="Nhập tên khách hàng" style="border-radius: 5px;opacity: 1;background-color:#F0F0F0;width:80%;">
                            {{showErrors($errors,'phone')}}
                    </li>
                    <li class="nav-item filter-li" id="customer-name" style="margin:5%;" >
                        <p class="filter-title"> <img src="./image/icon-marker.svg"> Địa Chỉ</p>
                        <input type="text" name="addrees" class="filter-input" placeholder="Nhập tên khách hàng" style="border-radius: 5px;opacity: 1;background-color:#F0F0F0;width:80%;">
                            {{showErrors($errors,'addrees')}}
                    </li>
                    <li class="nav-item filter-li" id="customer-name" style="margin:5%;" >
                        <p class="filter-title"> <img src="./image/Icon-feather-phone.svg">Email</p>
                        <input type="text" name="email" class="filter-input" placeholder="Nhập tên khách hàng" style="border-radius: 5px;opacity: 1;background-color:#F0F0F0;width:80%;">
                            {{showErrors($errors,'email')}}
                    </li>
                    <li class="nav-item filter-li"  style="margin-top:16px;margin-left:20px">
                        <p class="filter-title">Ngày Đặt</p>
                        <input id="date" type="date"  name="order_date" class="filter-input" value="" >
                    </li>
                    <li class="nav-item filter-li"  style="margin-left:20px">
                        <p class="filter-title">Ngày Giao</p>
                        <input id="date" type="date"  name="order_start_date" class="filter-input" value="" >
                    </li>
                    <li class="nav-item filter-li"  style="margin-left:20px">
                        <p class="filter-title">Ngày kết thúc</p>
                        <input id="date" type="date"  name="order_complete_date" class="filter-input" value="" >
                    </li>
                </ul>
            </nav>
        </div>
        <div class="table-product1" >
            <h2 style="display:inline-block;margin-right:-12%;"><b>Danh Sách Sản Phẩm</b></h2>
            <button type="button" class="btn btn-link" data-toggle="modal" data-target="#exampleModal-add" style="margin-left:38%;">
                <b>+ Thêm Sản phẩm</b>
            </button>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><b>Mã </b></th>
                    <th><b>Ảnh sản phẩm</b></th>
                    <th><b>Tên Sản Phẩm</b></th>
                    <th><b>SL</b></th>
                    <th><b>đơn giá</b></th>
                    <th><b>Thành tiền</b></th>
                    <th><b>Action</b></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($cart as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><img src="./image/product/{{$row->options->img}}" class="img-prd"/></td>
                            <td>{{ $row->name }}</td>
                            <td> <input  onchange="updatecart('{{$row->rowId}}',this.value)" type="number" id="quantity" name="quantity" class="form-control input-number text-center" value="{{$row->qty}}"  style="width:62px"></td>
                            <td>{{ number_format($row->price,0,'','.') }} đ</td>
                            <td>{{ number_format($row->price*$row->qty,0,'','.') }} đ</td>
                            <td> <a onclick="return del()" href="/home/order/add/DelCart/{{$row->rowId}}" class="btn btn-link" style="color: red;">Delete</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="order-work" style="margin-top: 1%">
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
        <div class="admin-c" style="margin-top: 27%">
            <h4><b>Quản Lý A</b></h4>
            <select id="select-userorder" name="user_id" class="filter-input">
                {{ GetUserA($user,"") }}
            </select>
            {{showErrors($errors,'user_id')}}
            <h4><b>Quản Lý B</b></h4>
            <select id="select-userorder" name="user_id_b" class="filter-input">
                {{ GetUserB($userb,"") }}
            </select>
            {{showErrors($errors,'user_id_b')}}
            <h4><b>Quản Lý C</b></h4>
            <select id="select-userorder" name="user_id_c" class="filter-input">
            {{ GetUserC($userc,"") }}
            </select>
            {{showErrors($errors,'user_id_c')}}
        </div>

    </div>
    <div class="all-money" style="width: 62%;top: 157px;left: 462px;">
        <h4>Tong Tien:</h4>
        <h1>{{ $total }} VND</h1>
    </div>
    </form>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal-add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Thêm Sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 col-md-10 col-lg-8">
                    <form class="card card-sm" style="width:155%;" enctype="multipart/form-data" method="Get">
                        @csrf
                        <div class="table-product" id="table-data" style="display: contents;" >
                            <table class="table table-hover">
                                <thead>
                                <tr id="prd-tr">
                                    <th><b> Mã</b></th>
                                    <th><b>Tên Sản Phẩm</b></th>
                                    <th><b>SL</b></th>
                                    <th><b>đơn giá</b></th>
                                    <th><b>action</b></th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($prd as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->name_product }}</td>
                                        <td>
                                        <input id="quantity" name="quantity" type="number" class="form-control input-number text-center" value="{{ $row->quantity }}" >
                                        </td>
                                        <td>{{ number_format($row->price_product,0,'','.') }} đ</td>
                                        <td> <a href="/home/order/add/add-cart/{{ $row->id }}" id="btn-prd-card"  class="btn btn-primary" >Thêm sản phẩm</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>

            </div>
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
		            $('#img_cate').attr('src',e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$(document).ready(function() {
		    $('#img_cate').click(function(){
		        $('#img_customer').click();
		    });
		});

        function del(){
             return confirm("Có muốn xóa San Pham này ko ?")
        }

        function updatecart(rowId,qty){
                $.get("/home/order/add/update/"+rowId+"/"+qty,
            function(data){
                if(data=="success"){
                    location.reload();
                }else{
                    alert("Error");
                }
            });

            }
    </script>
    <script>
        $(document).ready(function(){
           $("#cat 1").click(function(){
               alert('1');
           })
        })
    </script>
@endsection
