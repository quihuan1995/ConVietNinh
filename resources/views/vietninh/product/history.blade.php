@extends('vietninh.home')
@section('title','history')
@section('product')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
        <div class="mask"></div>
        <div class="add-history" >
            <div class="col-12 col-md-10 col-lg-8">
                <h2><b>Thêm Lịch sử xuất nhập</b></h2>
                <form method="POST" enctype="multipart/form-data" style="padding:15px;display:flex">
                    @csrf
                    <div class="form-group" style="margin-right: 35px;">
                        <label for="">Ngày Nhập/Xuất</label>
                        <input id="date-history" type="date" name="histories" class="form-control" placeholder="" aria-describedby="helpId" style="">
                    </div>
                      <div class="form-group" style="margin-right: 35px;">
                        <label for="">Kiểu</label>
                        	<select name="ImExPort" id="ImExPort" class="filter-input" >
			        		<option value="1">Nhap</option>
			                <option value="0">Xuat</option>
			        	</select>

                    </div>
                      <div class="form-group">
                        <label for="">Số lượng</label>
                        <input type="number" name="quantity" id="quantity-history" class="form-control" placeholder="" aria-describedby="helpId" style="background-color:#F0F0F0">
                    </div>
                     <div class="form-group" style="  top: 87%;position: absolute;left: 100%;">
                        <label for="">Đơn giá</label>
                        <input type="number" name="price" id="price-history" class="form-control" placeholder="" aria-describedby="helpId" style="background-color:#F0F0F0">
                    </div>
                     <button class="btn btn-primary" id="btn-history" type="submit" style="">thêm</button>

                </form>
            </div>
        </div>

@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function(){
            setTimeout(function(){
			$('.mask').fadeIn();
			$('.add-history').fadeIn();
            },0);
        });
    </script>
    @endsection
