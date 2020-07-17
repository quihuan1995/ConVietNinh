<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\StatisticalAdminController;
use Carbon\Carbon;
use App\customer;
use App\Order;
use App\UserB;
use App\UserC;
use App\UserD;
use App\User;
use App\contact;

class DashBoardController extends Controller
{
    public function GetDashboard()
    {
        $day_n=Carbon::now()->format('d');
        $year_n=Carbon::now()->format('Y');
        $month_n=Carbon::now()->format('m');
        for($i=1;$i<=$month_n;$i++)
        {
            $monthjs[$i]='Tháng '.$i;
            $numberjs[$i]=order::where('order_status',2)->whereMonth('updated_at',$i)->whereYear('updated_at', $year_n)->sum('total_price');
        }
        $data['monthjs']=$monthjs;
        $data['numberjs']=$numberjs;
        $data['order']=order::where('order_status',2)->count();
        $data['orders']=Order::where('order_status',0)->orderby('updated_at','DESC')->paginate(10);
        $data['userc']=UserC::where('state',1)->take(4)->get();
        $data['userd']=UserD::where('state',1)->take(4)->get();
        $data['contact'] = contact::all();
        return view('vietninh.dashboard.dashboard',$data,compact('month_n','year_n','day_n'));
    }


}