<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Events\RedisEvent;
use App\contact;

class HomeController extends Controller
{
    public function GetHome()
    {
        $data['contact']=contact::all();
        return view('vietninh.home',$data);
    }
    public function Contact(Request $request){
        $contact= contact::create($request->all());
        event(
            $e=new RedisEvent($contact)
        );
        return redirect()->back();
    }
}
