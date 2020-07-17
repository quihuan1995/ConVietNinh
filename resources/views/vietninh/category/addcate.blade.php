@extends('vietninh.home')
@section('title','Add Category')
@section('category')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="AddCatemanagement"class="tabContent" style="padding: 0;border: none;">
    <div class="head-category" >
        <div id="category-span" >
            <span >Tạo danh mục</span>
        </div>
    </div>
    @if (session('thongbao'))
        <div class="alert bg-success" role="alert" style="color: #fff">
        <i class="far fa-check-circle"></i> <span>{{session('thongbao')}}</span>
        </div>
    @endif
<div class="add-category">
    <form method="post" enctype="multipart/form-data" action="/home/category/add">
        @csrf
        <button type="submit" class="btn btn-primary" id="save-category">Luu danh muc</button>
        <div class="info-mobilecate">
            <h3>Thong tin chung</h3>
            <div class="form-group" style="display: grid">
                <label for="">Ảnh đại diện</label>
                    {{showErrors($errors,'images_category')}}
                    <input id="images_category" type="file" name="images_category" class="form-control hidden" style="display:none" onchange="changeImg(this)">
                <img id="img_cate" class="thumbnail"src="./image/icon-add.svg" style="width:30%;position:inherit;cursor: pointer;">
            </div>
            <div class="form-group">
                <label for="">Tên danh mục</label>
                <input type="text" id="name-category" name="categories" class="filter-input" placeholder="Nhập tên danh muc">
                {{showErrors($errors,'categories')}}
            </div>

            <div class="form-group">
                <label for="">Thuộc danh mục</label>
                <select id="select-category" name="name" class="form-control">
                    <option value="0">Chọn danh muc</option>
                    {{ GetCate($category,0,"",0) }}
                </select>
            </div>
        </div>
            <div class="table-suggest" >
                <h3>Câu gợi ý</h3>
                <a href="/home/category/addmenu" id="add-menu" class="btn btn-link" >
                    <b>+ Thêm gợi ý</b>
                </a>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th><b>Tên gợi ý <img src="./image/arrow-sort.svg" /></b></th>
                        <th><b>Action</b></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($menu as $row)
                    <tr>
                        <td>{{ $row->name }}</td>
                        <td style="display: flex">
                            <a href="/home/category/editmenu/{{$row->id}}" class="btn btn-link" style="color: #33ACFF;">Edit</a>
                            <a onclick="return del()" href="/home/category/del/{{$row->id}}" class="btn btn-link" style="color: red">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
        </div>
</div>

{{-- <div class="table-category-product"  >
    <h3>Sản phẩm trong danh mục</h3>
    <table class="table table-hover">
        <thead>
        <tr >
            <th><b>Mã SP<img src="./image/arrow-sort.svg" /></b></th>
            <th><b>Hình ảnh</b></th>
            <th><b>Tên Sản Phẩm</b></th>
            <th><b>Giá Sản Phẩm</b></th>
            <th><b>Số lượng</b></th>
            <th><b>Trạng Thái</b></th>
            <th><b>ACTION</b></th>
        </tr>
        </thead>
        <tbody>

        <tr>
            <td>xxxx</td>
            <td><img src="./image/image-Logo.png" class="img-prd"/></td>
            <td>ádfadsfsdafasdfsdafdsa</td>
            <td>1000000000</td>
            <td>1 </td>
            <td>con hang</td>
            <td><a href="#" class="btn btn-link" style="color: red">Delete</a></td>
        </tr>
        <tr>
            <td>xxxx</td>
            <td><img src="./image/image-Logo.png" class="img-prd"/>/></td>
            <td>ádfadsfsdafasdfsdafdsa</td>
            <td>1000000000</td>
            <td>1 </td>
            <td>con hang</td>
            <td><a href="#" class="btn btn-link" style="color: red">Delete</a></td>
        </tr>
        <tr>
            <td>xxxx</td>
            <td><img src="./image/image-Logo.png" class="img-prd"/>/></td>
            <td>ádfadsfsdafasdfsdafdsa</td>
            <td>1000000000</td>
            <td>1 </td>
            <td>con hang</td>
            <td><a href="#" class="btn btn-link" style="color: red">Delete</a></td>
        </tr>
        <tr>
            <td>xxxx</td>
            <td><img src="./image/image-Logo.png" class="img-prd"/>/></td>
            <td>ádfadsfsdafasdfsdafdsa</td>
            <td>1000000000</td>
            <td>1 </td>
            <td>con hang</td>
            <td><a href="#" class="btn btn-link" style="color: red">Delete</a></td>
        </tr>

        </tbody>
    </table>
    <nav aria-label="Page navigation example" style="position: relative;left: 748px;">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul>
    </nav>
</div> --}}
</form>
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
		        $('#images_category').click();
		    });
		});

    function del(){
        return confirm("Có muốn xóa Cau Goi Y này ko ?")
    }
    </script>
@endsection
