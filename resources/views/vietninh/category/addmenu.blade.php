@extends('vietninh.home')
@section('title','Add Menu')
@section('category')
     class="list-group-item list-group-item-action active"
@endsection
@section('content')
        <div class="mask"></div>
        <div class="menu-body" >
            <div class="col-12 col-md-10 col-lg-8">
                <h2><b>Thêm Câu Gợi Ý</b></h2>
                <form method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Tên câu gợi ý</label>
                        <input type="text" name="name" id="input-suggest" class="form-control" placeholder="" aria-describedby="helpId" style="background-color:#F0F0F0;border-radius: 26px; opacity: 1;width: 629px;height: 52px;">
                        <button class="btn btn-link" id="btn-suggest" type="submit" style="top:80%;">thêm</button>
                    </div>
                    <div class="form-group">
                    <label for="">Thuộc danh mục</label>
                    <select id="select-category" name="categories_id" class="form-control">
                        <option value="0">Chọn danh muc</option>
                        {{ GetCate($category,0,"",0) }}
                    </select>
                    </div>
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
			$('.menu-body').fadeIn();
            },0);
        });
    </script>

@endsection
