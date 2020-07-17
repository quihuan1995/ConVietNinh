@include('vietninh.slide-menu')

                <!-- main -->
                <div class="col-md-8">
                    <div class="main-content" >

                        @yield('content')

                    </div>
                </div>
                <!--End main -->

@include('vietninh.slide-chat')

@section('script')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
<script src="ckeditor/ckeditor.js" type="text/javascript"></script>

    <script>
        var socket =io('http://localhost:6001');
        socket.on('vietninh:contact',function(data){
            console.log(data)
            if($('#'+data.id).length==0){
                $('#data').append('<p><strong>'+data.name+'</strong>: '+data.phone+data.comment+'</p>')
            }else{
                console.log('You have Contact')
            }
        })
    </script>
    <script>
        function out(){
            return confirm('Chắc chắn muốn đăng xuất ko ?');
        }
    </script>
@show


    </body>
</html>

