<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;
use App\User;

class LoginVNController extends Controller
{
     /**
     * Show view login
     */
    public function GetLogin()
    {
        return view('vietninh.login');
    }

    /**
     * Check login
     */
    public function CheckLogin(Request $request){
        $msg = 'fail';

        $phone = $request->phone;
        $password = $request->password;
        if (Auth::attempt(['phone' => $phone, 'password' => $password])) {
            $msg='success';
        }


        return response()->json(array('msg'=> $msg), 200);
    }
    public function Logout(){
        Auth::logout();
        return redirect('login');
    }
}