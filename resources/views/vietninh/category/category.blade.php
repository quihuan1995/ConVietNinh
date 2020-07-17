@extends('vietninh.home')
@section('title','Category')
@section('category')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
<div id="Categorymanagement"class="tabContent" style="padding: 0;border: none;">
    <div class="head-category" >
        <div id="category-span" >
            <span >Danh sách danh mục</span>
        </div>
        <div id="btn-category" >
            <a class="btn btn-primary" href="/home/category/add" role="button" ><b>Tạo danh mục</b></a>
        </div>
    </div>
    @if (session('thongbao'))
        <div class="alert bg-success" role="alert" style="color: #fff">
        <i class="far fa-check-circle"></i> <span>{{session('thongbao')}}</span>
        </div>
    @endif
    {{-- <div class="filter-form mb-2">
        <nav class="navbar navbar-expand">
            <ul class="navbar-nav row filter-ul">
                <li class="nav-item filter-li" id="category-name">
                    <p class="filter-title">Tên danh mục</p>
                    <input type="text" id="name-cate" name="name-cate" class="filter-input" placeholder="Nhập tên danh muc">
                </li>
                <li class="nav-item filter-li" id="category-level" style="margin-left: 7%">
                    <p class="filter-title">Loại sản phẩm</p>
                    <select id="select-cate" name="select-cate" class="filter-input">
                        <option value="0">Chọn danh muc</option>
                        {{ GetCate($category,0,"",0) }}
                    </select>
                </li>
            </ul>
        </nav>
    </div> --}}

    <div class="table-category" style="position: initial;">
        <table class="table table-hover">
            <thead>
            <tr>
                <th><b>HÌNH ẢNH </b></th>
                <th><b>TÊN DANH MỤC<img src="./image/arrow-sort.svg" /></b></th>
                <th><b>LEVEL</b></th>
                <th><b>SỐ LƯỢNG SP</b></th>
                <th><b>ACTION</b></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($category as $row)
                <tr>
                <td> <img src="./image/category/{{ $row->images_categories }}" class="img-prd" /> </td>
                <td>  {{ $row->categories }}</td>
                <td>
                    @if($row->child()->count()>0)
                            {{ $row->categories }}
                        @foreach ($row->child as $item)
                            <p>--|{{ $item->categories }}
                                <a href="/home/category/edit/{{ $item->id }}" class="btn btn-link" ><img src="./image/Icon awesome-pen.svg" class="imageicon2" ></a>
                                <a onclick="return del()" href="/home/category/delete/{{ $item->id }}" class="btn btn-link" style="color: red">X</a>
                            </p>
                            @if (count($item->child))
                                @foreach ($item->child as $item1)
                                    <p style="margin-left: 55px">---|{{ $item1->categories }}
                                        <a href="/home/category/edit/{{ $item1->id }}" class="btn btn-link" ><img src="./image/Icon awesome-pen.svg" class="imageicon2" ></a>
                                        <a onclick="return del()" href="/home/category/delete/{{ $item1->id }}" class="btn btn-link" style="color: red">X</a>
                                    </p>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td id="cate-td">
                    {{ $row->product->count('name_product') }}
                    @if($row->child()->count()>0)
                        @foreach ($row->child as $item)
                            <p>{{ $item->product->count('name_product') }}</p>
                            @if (count($item->child))
                                @foreach ($item->child as $item1)
                                    <p>{{ $item1->product->count('name_product') }}</p>
                                @endforeach
                            @endif
                        @endforeach
                    @endif
                </td>
                <td>
                    <a href="/home/category/edit/{{ $row->id }}" class="btn btn-link" style="color: #33ACFF;">Edit</a>
                    <a onclick="return del()" href="/home/category/delete/{{ $row->id }}" class="btn btn-link" style="color: red">Delete</a>

                </td>
                </tr>
                @endforeach
            </tbody>
        </table>
  	        <div align='right'>
		    	{{$category->links()}}
		    </div>
    </div>
</div>
@endsection
@section('script')
    @parent
    <script>
        function del(){
            return confirm("Có muốn xóa Danh Muc này ko ?")
    }
    </script>
@endsection
