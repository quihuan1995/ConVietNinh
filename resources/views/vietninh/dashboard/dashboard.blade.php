@extends('vietninh.home')
@section('title','Dashboard')
@section('dashboard')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
    <div id="dashboard" class="tabContent" style="padding: 0;border: none;">

        <div class="head-dashboard" >
            <div id="dash-span" >
                <span >Dashboard</span>
            </div>
            <div id="day-time" >
                <span >Ngày: {{ $day_n}}, tháng: {{ $month_n}}, Năm: {{ $year_n}}</span>
            </div>
        </div>

        <div class="menu-dashboard">
            <div class="menu-dashboard1" >
                <div id="img-jack">
                <img src="./image/support.svg" class="imageicon" />
            </div>
                <div id="span-p">
                    <span >Tổng doanh thu :</span>
                    <h2 style="color:white;"><b>{{number_format($numberjs[count($numberjs)])}} VNĐ</b></h2>
                </div>
            </div>
            <div class="menu-dashboard0"></div>
            <div class="menu-dashboard2" >
                <div id="img-jack">
                <img src="./image/product.svg" class="imageicon" />
            </div>
                <div id="span-p">
                    <span >Tổng đơn hàng :</span>
                    <h2 style="color:black;"><b>{{$order}}</b></h2>
                </div>
            </div>
        </div>

        <div class="the-membership">
            <h2><b>Quản Lý C</b></h2>
            <div id="ad-membership">
                @foreach ($userc as $row)
                <button class="tabbutton-qlyb" onclick="openCity(event, 'TênaccA')">
                    <div class="img-tabbuton"><img src="./image/user/{{ $row->avatar }}" /></div>
                    <span>{{ $row->name }}</span>
                </button>
                @endforeach
            </div>
            <div id="TênaccA" class="tabcontent">
                <div id="ad-membership" style="display:flex;justify-content: space-around;">
                    @foreach ($userd as $row)
                        <button class="tabbutton-qlyb" onclick="openCity(event, 'TênaccA')">
                            <img src="./image/user/{{ $row->avatar }}" />
                        <span>{{ $row->name }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="table-neworder" style="padding:40px" >
            <h2><b>Đơn hàng mới</b></h2>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th><b>Mã đơn hàng</b></th>
                    <th><b>Ảnh sản phẩm</b></th>
                    <th><b>Tên sản phẩm</b></th>
                    <th><b>Số lượng</b></th>
                    <th><b>đơn giá</b></th>
                    <th><b>Thành tiền</b></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $row)
                        <tr>
                            <td>{{ $row->id }}</td>
                            <td><img src="./image/product/{{$row->img}}" class="img-prd"/></td>
                                <td>{{ $row->name }}</td>
                                <td>{{$row->total_price_construction}}</td>
                                <td>{{ number_format($row->total,0,'','.') }} đ</td>
                                <td>{{ number_format($row->total_price,0,'','.') }} đ</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div align='right'>
            {{ $orders->links() }}
			</div>
        </div>
    </div>

@endsection
@section('script')
    @parent
    <script>
        function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent1");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
        }
    </script>
@endsection

