@extends('vietninh.home')
@section('title','ADD User')
@section('userd')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="AddUsermanagement"class="tabContent" style="padding: 60px;border: none;">
    <div class="head-addaccount">
        <h2><b>Tạo tài khoản</b></h2>
    </div>

        <div id="main-addaccount">
            <form method="POST" enctype="multipart/form-data" action="/home/user/add-d">
                @csrf
            <button type="submit" class="btn btn-primary" id="save-product">Luu Tai Khoan</button>
            <div class="filter-form mb-2" id="creat-edit-user">
                <nav class="navbar navbar-expand">
                    <ul class="navbar-nav row filter-ul" style="display: block;">
                    <h3>Thông tin chung</h3>
                    <li class="nav-item filter-li" id="customer-name" style="margin:5%;" >
                        <p class="filter-title">Ảnh đại diện</p>
                    <input id="avatar" type="file" name="avatar" class="form-control hidden" style="display: none" onchange="changeImg(this)">
                    <img id="img_prd" class="thumbnail"src="./image/icon-add.svg" style="width:30%;position:inherit;cursor: pointer;">
                    </li>
                        <li class="nav-item filter-li" id="customer-name" style="margin:5%;" >
                            <p class="filter-title"> <img src="./image/Icon feather-user.svg">Họ và Tên</p>
                            <input type="text" name="name" class="filter-input" placeholder="Nhập tên " style="border-radius: 5px;opacity: 1;background-color:#F0F0F0;width:80%;">
                          {{showErrors($errors,'name')}}
                        </li>

                        <li class="nav-item filter-li" id="number" style="margin:5%;" >
                            <p class="filter-title"><img src="./image/Icon-feather-phone.svg">Số điện thoại</p>
                            <input type="text" name="phone" class="filter-input" placeholder="Nhập sdt " style="border-radius: 5px;opacity: 1;background-color:#F0F0F0;width:80%;">
                    {{showErrors($errors,'phone')}}
                        </li>
                        <li class="nav-item filter-li" id="address" style="margin:5%;" >
                            <p class="filter-title"><img src="./image/icon-time.svg" >địa chỉ</p>
                            <textarea name="address" class="filter-input" placeholder="Nhập địa chỉ " style="color: black;background-color:#F0F0F0;margin-right: 5%;width:80%;"></textarea>
                              {{showErrors($errors,'address')}}
                        </li>

                    </ul>
                </nav>
            </div>
            <div id="choose-account">
                <h2 class="h-sale"><b>Loại Tài khoản</b></h2>
                <p>thuộc sự quản lý C:</p>
                <select id="select-user" name="user_id_c" class="filter-input">
                    <option value="1">D</option>
                    {{ GetUserC($userc,"") }}
                </select>
            </div>
            <div class="account-pass" style="top:140px;">
                <h4><b>Mật khẩu</b></h4>
                <div class="form-group">
                <label for=""> <img src="./image/Icon-feather-lock.svg" class="icon-lock" >Mật khẩu</label>
                    <input name="password" id="password" type="password" placeholder="Nhập mật khẩu" />
                    <img src="./image/Icon-feather-eye.svg"  id="hide1" style="  position: absolute;left: 290px;top: 102px;">
                      {{showErrors($errors,'password')}}
                </div>
               <div class="form-group">
                    <label for=""> <img src="./image/Icon-feather-lock.svg" class="icon-lock" >Nhập Mật khẩu</label>
                    <input name="password" id="password" type="password" placeholder="Nhập mật khẩu" />
                    <img src="./image/Icon-feather-eye.svg"  id="hide1" style="  position: absolute;left: 290px;top: 200px;">
                       {{showErrors($errors,'password')}}
                </div>
                <div class="form-group" style="display: contents">
                    <label class="filter-title" ><b>Mã Tài Khoản D</b></label>
                    <input id="user_id" type="text" name="user_id_d" class="filter-input" placeholder="Nhập mã "  >
                        {{showErrors($errors,'user_id_d')}}
                </div>
            </div>
            <div class="user-state">
                <div class="filter-form1 mb-2" >
                    <nav class="navbar navbar-expand">
                        <h3 class="h-sale"><b>Trạng Thái</b></h3>
                        <ul class="navbar-nav row filter-ul">
                            <li class="nav-item filter-li"   style="margin-left:6px;margin-top: 10px;">
                                <p class="filter-title">Ngày vào</p>
                                <input id="date" type="date" name="date_in" class="filter-input" value="2018-06-12t19:20" >
                            </li>
                            <li class="nav-item filter-li"  style="margin-top: 10px;">
                                <p class="filter-title">Ngày Nghỉ</p>
                                <input id="date" type="date" name="date_out" class="filter-input" value="2018-06-12t19:20"  >
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </form>
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
		            $('#img_prd').attr('src',e.target.result);
		        }
		        reader.readAsDataURL(input.files[0]);
		    }
		}
		$(document).ready(function() {
		    $('#img_prd').click(function(){
		        $('#avatar').click();
		    });
		});


    </script>
@endsection
