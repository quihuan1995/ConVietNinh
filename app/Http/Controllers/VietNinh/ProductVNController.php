<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\AddPrdRequest;
use App\Http\Requests\EditPrdRequest;
use App\Image;
use App\Product;
use App\categories;
use App\history;
use App\contact;

class ProductVNController extends Controller
{
    function GetProduct(){
        $data['contact']=contact::all();
        $data['products']=product::paginate(10);
        return view('vietninh.product.product',$data)   ;
    }
    function GetAddPrd(){
        $data['contact']=contact::all();
        $data['history']=history::all();
        $data['category']=categories::all();
        return view('vietninh.product.addprd',$data);
    }
    function GetEditPrd($id){
        $data['contact']=contact::all();
        $data['products']=product::find($id);
        $data['category']=categories::all();
        return view('vietninh.product.editprd',$data);
    }

    function PostAddPrd(AddPrdRequest $request){
        $prd=new product;
        $prd->name_product=$request->name_product;
        $prd->price_product=$request->price_product;
        $prd->price_product_sale=$request->price_product_sale;
        $prd->quantity=$request->quantity;
        $prd->type_product=$request->type_product;
        $prd->sku=$request->sku;
        $prd->content=$request->content;
        if($request->hasFile('images_product'))
        {
        $file = $request->images_product;
        $filename= str::random(9).'.'.$file->getClientOriginalExtension();
        $file->move('vietninh/image/product', $filename);
        $prd->images_product= $filename;
        }
        else {
            $prd->images_product='';
        }

        $prd->start_discount=$request->start_discount;
        $prd->stop_discount=$request->stop_discount;
        $prd->menu_id=$request->menu_id;
        $prd->active=$request->active;
        $prd->categories_id=$request->type_product;
        $prd->save();
            return redirect('/home/product')->with('thongbao','Thêm sản phẩm thành công');
    }

    function PostEditPrd(EditPrdRequest $request,$id){
        $prd=product::find($id);
        $prd->name_product=$request->name_product;
        $prd->price_product=$request->price_product;
        $prd->price_product_sale=$request->price_product_sale;
        $prd->quantity=$request->quantity;
        $prd->type_product=$request->type_product;
        $prd->sku=$request->sku;
        $prd->content=$request->content;
        if($request->hasFile('images_product')){
                if($prd->images_product!='')
                {
                unlink('vietninh/image/product/'.$prd->images_product);
                }
            $file = $request->images_product;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/product', $filename);
            $prd->images_product= $filename;
            }
            $prd->start_discount=$request->start_discount;
            $prd->stop_discount=$request->stop_discount;
            $prd->menu_id=$request->menu_id;
            $prd->active=$request->active;
            $prd->categories_id=$request->type_product;
            $prd->save();
            return redirect('/home/product')->with('thongbao','Sua sản phẩm thành công');
    }
    function DeletePrd($id){
        product::destroy($id);
        return redirect()->back()->with('thongbao','Xóa sản phẩm thành công');
    }


    function SearchPrd(request $request){
        if($request->name_product){
            $data['products']=product::where('name_product','like','%'.$request->name_product.'%')->paginate(10);
        }elseif($request->menu_id){
            $data['products']=product::where('menu_id','like','%'.$request->menu_id.'%')->paginate(10);
        }elseif($request->start){
            $data['products']=product::whereBetween('price_product',[$request->start,$request->end])->paginate(10);
        }elseif($request->active){
            $data['products']=product::where('active','like','%'.$request->active.'%')->paginate(10);
        }else{
            $data['products']=product::where('image/product','<>','no-img.jpg')->paginate(10);
        }
        $data['category']=categories::all();
        $data['contact']=contact::all();
        return view('vietninh.product.product',$data)   ;
    }

    function History(){
        $data['contact']=contact::all();
        return view('vietninh.product.history',$data);
    }
    function AddHistory(Request $request){
        $his= new history();
        $his->histories=$request->histories;
        $his->ImExPort=$request->ImExPort;
        $his->quantity=$request->quantity;
        $his->price=$request->price;
        $his->total_price=$his->quantity*$his->price;
        $his->save();
        return redirect('/home/product/add')->with('thongbao','Them Lich su thành công');
    }

}