<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\OrderRequest;
use App\contact;
use App\UserD;
use App\User;
use App\UserB;
use App\UserC;
use App\Order;
use App\Order_item;
use App\OrderItemThicong;
use App\OrderForD;
use App\Product;
use App\categories;
use App\customer;
use Cart;

class OrderVNController extends Controller
{
    public function GetOrder()
    {
        $data['contact'] = contact::all();
        $data['customer']=customer::orderby('state','ASC')->paginate(10);
        return view('vietninh.order.order',$data);
    }
    public function DetailOrder($id)
    {
        $data['user']=user::all();
        $data['userb']=userB::where('state',1)->get();
        $data['userc']=userC::where('state',1)->get();
        $data['userd']=userD::where('state',1)->get();
        $data['contact'] = contact::all();
        $data['customer']=customer::find($id);
        return view('vietninh.order.detailorder',$data);
    }
    public function DeliverOrder($id){
        $data['user']=user::all();
        $data['userb']=userB::where('state',1)->get();
        $data['userc']=userC::where('state',1)->get();
        $data['userd']=userD::where('state',1)->get();
        $data['contact'] = contact::all();
        $data['customer']=customer::find($id);
        return view('vietninh.order.deliverorder',$data);
    }

    public function SuccessOrder($id)
    {
        $data['user']=user::all();
        $data['userb']=userB::where('state',1)->get();
        $data['userc']=userC::where('state',1)->get();
        $data['userd']=userD::where('state',1)->get();
        $data['contact'] = contact::all();
        $data['customer']=customer::find($id);
        return view('vietninh.order.successorder',$data);
    }
    public function WorkOrder($id)
    {
        $customer=customer::find($id);
        $customer->state=2;
        foreach($customer->order as $row){
            $row->order_status=1;
            $row->save();
        }
        $customer->save();
        return redirect('/home/order')->with('thongbao1','Đã nhận đơn hàng');
    }
    public function ActiveOrder($id)
    {
        $customer=customer::find($id);
        $customer->state=3;
        foreach($customer->order as $row){
            $row->order_status=2;
            $row->save();
        }
        $customer->save();
        return redirect('/home/order')->with('thongbao','Đã hoàn thành đơn hàng');
    }
    public function GetAddOrder()
    {
        $data['user']=user::all();
        $data['userb']=userB::where('state',1)->get();
        $data['userc']=userC::where('state',1)->get();
        $data['userd']=userD::where('state',1)->get();
        $data['contact'] = contact::all();
        $data['cart']=Cart::content();
        $data['total']=Cart::total(0,'',',');
        $data['category']=categories::all();
        $data['prd']=product::where('active',1)->get();
        return view('vietninh.order.addorder',$data);

    }
    public function PostAddOrder(OrderRequest $request){
        $customer=new customer;
        $customer->name=$request->name;
        $customer->addrees=$request->addrees;
        $customer->phone=$request->phone;
        $customer->email=$request->email;
        $customer->state=1;
        $customer->order_date=$request->order_date;
        $customer->order_start_date=$request->order_start_date;
        $customer->order_complete_date=$request->order_complete_date;
        $customer->total= Cart::total(0,'','');
            if($request->hasFile('img_customer'))
            {
            $file = $request->img_customer;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/customer', $filename);
            $customer->img_customer= $filename;
            }
            else {
                $customer->img_customer='';
            }
        $customer->save();
        foreach(Cart::content() as $prd){
            $order = new order;
            $order->total=$prd->price;
            $order->total_price=Cart::total(0,'','');
            $order->addrees=$customer->addrees;
            $order->user_id_b=$request->user_id_b;
            $order->user_id_c=$request->user_id_c;
            $order->user_id=$request->user_id;
            $order->total_price_construction=$prd->qty;
            $order->img=$prd->options->img;
            $order->name=$prd->name;
            $order->order_status=$customer->state;

            $order->order_date=$customer->order_date;
            $order->order_start_date=$customer->order_start_date;
            $order->order_complete_date=$customer->order_complete_date;

            $order->customer_id=$customer->id;
            $order->save();

        }
        Cart::destroy();
        return redirect('/home/order')->with('thongbao','Tạo đơn hàng thành công');
    }
    public function UpdateCart($rowId,$qty){
        Cart::update($rowId, $qty);
        return "success";
    }
    public function DelCart($rowId){
        Cart::remove($rowId);
        return redirect()->back();
    }
    public function AddCart(Request $request,$id){
        $prd=product::find($request->id);
        $cart = ['id' => $id,
                    'name' => $prd->name_product,
                    'qty' => $prd->quantity,
                    'price' =>$prd->price_product,
                    'weight'=>0,
                    'options' => ['img' =>$prd->images_product]
                ];
        Cart::add($cart);
        return redirect()->back();
    }

    public function SearchOrder(Request $request){
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
        }elseif($request->order_start_date){
            $data['customer']=customer::where('order_start_date','like','%'.$request->order_start_date.'%')->paginate(10);
        }elseif($request->order_stop_date){
            $data['customer']=customer::where('order_stop_date','like','%'.$request->order_stop_date.'%')->paginate(10);
        }else{
            $data['customer']=customer::where('image/customer','<>','')->paginate(10);
        }
        $data['contact'] = contact::all();
        return view('vietninh.order.order',$data);
    }
}