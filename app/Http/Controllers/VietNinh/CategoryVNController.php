<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddCateRequest;
use Illuminate\Support\Str;
use App\categories;
use App\Menu;
use App\product;
use App\contact;
class CategoryVNController extends Controller
{
    function GetCategory(){
        $data['contact']=contact::all();
        $data['category']=categories::where('name',0)->paginate(10);
        return view('vietninh.category.category',$data);
    }

    function GetAddCate(){
        $data['contact']=contact::all();
        $data['category']=categories::all();
        $data['menu']=menu::all();
        return view('vietninh.category.addcate',$data);
    }
    function GetEditCate($id){
        $data['cate']=categories::find($id);
        $data['category']=categories::all();
        $data['contact']=contact::all();
        return view('vietninh.category.editcate',$data);
    }

    function Menu(){
        $data['category']=categories::all();
        $data['contact']=contact::all();
        return view('vietninh.category.addmenu',$data);
    }

    function AddMenu(Request $request){
        $menu = new Menu();
        $menu->name=$request->name;
        $menu->categories_id=$request->categories_id;
        $menu->save();
        return redirect('/home/category/add')->with('thongbao','them cau goi y thanh cong');
    }
    function GetEditMenu($id){
        $data['contact']=contact::all();
        $data['menu']=menu::find($id);
        $data['category']=categories::all();
        return view('vietninh.category.editmenu',$data);
    }
    function EditMenu(Request $request,$id){
        $menu = Menu::find($id);
        $menu->name=$request->name;
        $menu->categories_id=$request->categories_id;
        $menu->save();
        return redirect('/home/category/add')->with('thongbao','Sua cau goi y thanh cong');
    }
    function PostAddCate(AddCateRequest $request){
        $category = new categories;
            if($request->hasFile('images_categories'))
            {
            $file = $request->images_categories;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/category', $filename);
            $category->images_categories= $filename;
            }
            else {
                $category->images_categories='';
            }
            $category->categories=$request->categories;
            $category->name=$request->name;
            $category->parent_id=$request->name;
            $category->save();

            return redirect('/home/category')->with('thongbao','Thêm danh mục thành công ');

    }
    function PostEditCate(AddCateRequest  $request, $id){
        $category=categories::find($id);
            if($request->hasFile('images_categories')){
                if($category->images_categories!='')
                {
                    unlink('vietninh/image/category/'.$category->images_categories);
                }
            $file = $request->images_categories;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/category', $filename);
            $category->images_categories= $filename;
            }
            $category->categories=$request->categories;
            $category->name=$request->name;
            $category->save();
            return redirect('/home/category')->with('thongbao','Sửa danh mục thành công ');

    }
    function DeleteCate($id){
        categories::destroy($id);
        return redirect()->back()->with('thongbao','Xóa danh muc thành công');
    }
    function DeleteMenu($id){
        menu::destroy($id);
        return redirect()->back()->with('thongbao','Xóa cau goi y thành công');
    }

}