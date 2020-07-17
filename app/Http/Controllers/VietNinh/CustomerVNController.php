<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\customer;
use App\Order;
use App\contact;
class CustomerVNController extends Controller
{
    function GetCustomer(){
        $data['contact'] = contact::all();
        $data['customer']=customer::orderby('state','ASC')->paginate(10);
        return view('vietninh.customer.customer',$data);
    }
    function DetailCustomer($id){
        $data['contact'] = contact::all();
        $data['customer']=customer::find($id);
        return view('vietninh.customer.detailcustomer',$data);
    }
    function SearchCustomer(Request $request){
        if($request->name){
            $data['customer']=customer::where('name','like','%'.$request->name.'%')->paginate(10);
        }elseif($request->id){
            $data['customer']=customer::where('id','like','%'.$request->id.'%')->paginate(10);
        }elseif($request->phone){
            $data['customer']=customer::where('phone','like','%'.$request->phone.'%')->paginate(10);
        }elseif($request->addrees){
            $data['customer']=customer::where('addrees','like','%'.$request->addrees.'%')->paginate(10);
        }elseif($request->state){
            $data['customer']=customer::where('state','like','%'.$request->state.'%')->paginate(10);
        }else{
            $data['customer']=customer::where('image/customer','<>','')->paginate(10);
        }
        $data['contact'] = contact::all();
        return view('vietninh.customer.customer',$data);
    }
}