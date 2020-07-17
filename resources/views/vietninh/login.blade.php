<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <!-- Fonts -->
        <base href="{{asset('').'vietninh/'}}">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
          <link rel="stylesheet" href="css/mdb.min.css">
          <script type="text/javascript" src="js/mdb.min.js"></script>
        <!-- Styles -->
        <style>
          body{
            margin: 0;
            padding:0;
            background-color: #33ACFF;

          }
          a{
            cursor: pointer
          }
        input[type=tel]  {
            width: 70%;
            height: 60px;
          padding: 10px 20px;
          margin: 8px 0;
          border-radius: 11px;
          text-align: left;
            letter-spacing: 1px;
            color: black;
            opacity: 1;
          background-color: #F0F0F0;
          padding-left: 48px;
         font-size: larger;
         border-width: 0px;
        }
        input[type=text]  {
            width: 70%;
            height: 60px;
          padding: 10px 20px;
          margin: 8px 0;
          border-radius: 11px;
          text-align: left;
            letter-spacing: 1px;
            color: black;
            opacity: 1;
          background-color: #F0F0F0;
          padding-left: 48px;
         font-size: larger;
         border-width: 0px;
        }
        input[type=password] {
            width: 70%;
             height: 60px;
          padding: 10px 20px;
          margin: 8px 0;
          border-radius: 11px;
          text-align: left;
         letter-spacing: 1px;
         color: black;
        opacity: 1;
          background-color: #F0F0F0;
          padding-left: 48px;
         font-size: larger;
         border-width: 0px;
        }
        .classCenter {
           text-align: center;
        }
        .divLogin {
            background-color: #fff;
            width: 55%;
            text-align: center;
            padding-top: 9%;
            height: 530px;
            border-radius: 10px;
            opacity: 1;
            margin: 22%;
        }
        .logo{
          margin-bottom:30px
        }
button{
    height: 70px;
    width:70%;
    padding:0 20px;
    background-color:#33ACFF;
    box-shadow: 3px 3px 10px #33ACFF4D;
    border-radius: 10px;
    opacity: 1;
    margin-top:20px;
}
.icon-phone{
    position: absolute;
    margin-left: 10px;
    margin-top: 23px;
    float: left;
    width: 30px;
    height: 30px;
}
.icon-lock{
    position: absolute;
    margin-left: 10px;
    margin-top: 23px;
    float: left;
    width: 30px;
    height: 30px;
}
.eye{
    position: absolute;
    margin-left: -45px;
    margin-top: 25px;
    float: right;
    width: 30px;
    height: 30px;
    display: inline-flex;
}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row" style="margin-right: 94px;
            margin-left: 54px;
            margin-top: 55px;">
                <div class="col-md-7 divLogin">
                  <div class="logo">
                    <img src="./image/vietninh.png" style="width:285px;height:95px;">
                  </div>
                  <!--  @if(session('thongbao'))
                  <div class="alert alert-danger" role="alert">
                  <strong>{{session('thongbao')}}</strong>
                  </div>
                  @endif  -->

                      <div>
                        <img src="./image/icon-phone.svg" class="icon-phone" ><input name="phone" id="phone" type="tel" placeholder="Số điện thoại" required/>

                    </div>
                    <div>
                        <img src="./image/Icon map-locksmith.svg" class="icon-lock" ><input name="password" id="password" type="password" placeholder="password" required/>
                      <span class="eye" onclick="ShowHide()">
                        <img src="./image/Icon awesome-eye.svg" style="display: none;" id="hide1">
                        <img src="./image/Icon awesome-eye-slash.svg" style="margin-left: -3px;" id="hide2">
                    </span>
                    </div>
                    <div class="divButton">
                        <button  class="btn-login" data-url="/home">
                        <span style="font-weight: bold;color:#fff;">Đăng nhập</span>
                         </button>
                      <!-- <button type="submit" >
                        <span style="font-weight: bold;color:#fff;">Đăng ký</span>
                      </button> -->
                    </div>

                  </div>

                </div>
            </div>
        </div>
    </body>
</html>
<script>
    $(document).ready(function() {
            $(document).on('click', '.btn-login', function() {
                let phone = $('#phone').val();
                let password = $('#password').val();
                let self = $(this);
                if (phone && password) {
                    $.ajax({
                        type: 'post',
                        url: '/checklogin',
                        data: {
                            _token: "{{ csrf_token() }}",
                            phone: phone,
                            password: password,
                        },
                        dataType: 'json',
                        success: function(data) {

                          if (data.msg == 'success') {
                            window.location.href = self.attr('data-url');
                          } else {
                            alert("tai khoan,mat khau ko chinh xac");
                          }
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                } else {
                    alert("Sdt hoac password khong duoc de rong");
                }
            });
    });

    function ShowHide(){
        var a = document.getElementById('password');
        var b = document.getElementById('hide1');
        var c = document.getElementById('hide2');

        if(a.type === 'password'){
            a.type='text';
            b.style.display='block';
            c.style.display='none';
        }else{
            a.type='password';
            b.style.display='none';
            c.style.display='block';
        }
    }
</script>

