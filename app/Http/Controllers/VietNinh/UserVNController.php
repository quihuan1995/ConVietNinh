<?php

namespace App\Http\Controllers\VietNinh;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Requests\AddUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Http\Requests\AddUserDRequest;
use App\Http\Requests\EditUserDRequest;
use App\UserB;
use App\UserC;
use App\UserD;
use App\User;
use App\contact;
class UserVNController extends Controller
{
    public function GetUserC()
    {
        $data['userc']=userC::paginate(20);
        $data['contact']=contact::all();
        return view('vietninh.user.user_c', $data);
    }
    public function GetUserD()
    {
        $data['userd']=userd::paginate(20);
        $data['contact']=contact::all();
        return view('vietninh.user.user_d', $data);
    }
    public function GetaddUser_C()
    {
        $data['userb']=userB::all();
        $data['contact']=contact::all();
        return view('vietninh.user.adduser_C', $data);
    }
    public function PostaddUser_C(AddUserRequest $request)
    {
        $users= new userC;
        $users->name=$request->name;
        $users->phone=$request->phone;
        $users->address=$request->address;
        $users->password=bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            $file=$request->avatar;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/user', $filename);
            $users->avatar=$filename;
        } else {
            $users->avatar='';
        }
        $users->user_id_b=$request->user_id_b;
        $users->user_id_c=$request->user_id_c;
        $users->state=1;
        $users->date_in=$request->date_in;
        $users->date_out=$request->date_out;
        $users->save();
        return redirect('/home/user')->with('thongbao1', 'Thêm tài khoản C thành công');
    }
    public function GetEditUser_C($id)
    {
        $data['userc']=userC::find($id);
        $data['userb']=userB::all();
        $data['contact']=contact::all();
        return view('vietninh.user.edituser_C', $data);
    }
    public function PostEditUser_C(EditUserRequest $request, $id)
    {
        $users=userC::find($id);
        $users->name=$request->name;
        $users->phone=$request->phone;
        $users->address=$request->address;
        $users->password=bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            if ($users->avatar!='') {
                unlink('vietninh/image/user/'.$users->avatar);
            }

            $file = $request->avatar;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/user', $filename);
            $users->avatar= $filename;
        }
        $users->user_id_b=$request->user_id_b;
        $users->user_id_c=$request->user_id_c;
        $users->state=$request->state;
        $users->date_in=$request->date_in;
        $users->date_out=$request->date_out;
        $users->save();
        return redirect('/home/user')->with('thongbao1', 'Sua khoản C thành công');
    }
    public function DeleteUser_C($id)
    {
        UserC::destroy($id);
        return redirect()->back()->with('thongbao1', 'Xóa tài khoản thành công');
    }



    function GetaddUser_D(){
        $data['userc']=userC::all();
        $data['contact']=contact::all();
        return view('vietninh.user.adduser_D',$data);
    }
    function GetEditUser_D($id){
            $data['userd']=userD::find($id);
            $data['userc']=userC::all();
            $data['contact']=contact::all();
            return view('vietninh.user.edituser_D',$data);
    }
    public function PostaddUser_D(AddUserDRequest $request)
    {
        $users= new userD;
        $users->name=$request->name;
        $users->phone=$request->phone;
        $users->address=$request->address;
        $users->password=bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            $file=$request->avatar;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/user', $filename);
            $users->avatar=$filename;
        } else {
            $users->avatar='';
        }
        $users->user_id_c=$request->user_id_c;
        $users->user_id_d=$request->user_id_d;
        $users->state=1;
        $users->date_in=$request->date_in;
        $users->date_out=$request->date_out;
        $users->save();
        return redirect('/home/user')->with('thongbao2', 'Thêm tài khoản D thành công');
    }
        public function PostEditUser_D(EditUserDRequest $request, $id)
    {
        $users=userD::find($id);
        $users->name=$request->name;
        $users->phone=$request->phone;
        $users->address=$request->address;
        $users->password=bcrypt($request->password);
        if ($request->hasFile('avatar')) {
            if ($users->avatar!='') {
                unlink('vietninh/image/user/'.$users->avatar);
            }
            $file = $request->avatar;
            $filename= str::random(9).'.'.$file->getClientOriginalExtension();
            $file->move('vietninh/image/user', $filename);
            $users->avatar= $filename;
        }
        $users->user_id_c=$request->user_id_c;
        $users->user_id_d=$request->user_id_d;
        $users->state=$request->state;
        $users->date_in=$request->date_in;
        $users->date_out=$request->date_out;
        $users->save();
        return redirect('/home/user')->with('thongbao2', 'Sua khoản D thành công');
    }
    public function DeleteUser_D($id)
    {
        UserD::destroy($id);
        return redirect()->back()->with('thongbao2', 'Xóa tài khoản thành công');
    }

    public function SearchUserC(Request $request){
        if($request->namec){
            $data['userc']=UserC::where('name','like','%'.$request->namec.'%')->paginate(20);
        }elseif($request->phonec){
            $data['userc']=userc::where('phone','like','%'.$request->phonec.'%')->paginate(20);
        }elseif($request->user_id_c){
            $data['userc']=userc::where('user_id_c','like','%'.$request->user_id_c.'%')->paginate(20);
        }elseif($request->addressc){
            $data['userc']=userc::where('addrees','like','%'.$request->addressc.'%')->paginate(20);
        }elseif($request->date_inc ){
            $data['userc']=userc::where('date_in','like','%'.$request->date_inc.'%')->paginate(20);
        }elseif($request->date_outc ){
            $data['userc']=userc::where('date_out','like','%'.$request->date_outc.'%')->paginate(20);
        }elseif($request->statec){
            $data['userc']=userc::where('state','like','%'.$request->statec.'%')->paginate(20);
        }else{
            $data['userc']=userc::where('image/users','<>','')->paginate(20);
        }
        $data['contact']=contact::all();
        return view('vietninh.user.user_c', $data);
    }
    public function SearchUserD(Request $request){
        if($request->named){
            $data['userd']=userd::where('name','like','%'.$request->named.'%')->paginate(20);
        }elseif($request->phoned){
            $data['userd']=userd::where('phone','like','%'.$request->phoned.'%')->paginate(20);
        }elseif($request->user_id_d){
            $data['userd']=userd::where('user_id_d','like','%'.$request->user_id_d.'%')->paginate(20);
        }elseif($request->addressd){
            $data['userd']=userd::where('addrees','like','%'.$request->addressd.'%')->paginate(20);
        }elseif($request->date_ind ){
            $data['userc']=userc::where('date_in','like','%'.$request->date_ind.'%')->paginate(20);
        }elseif($request->date_outd ){
            $data['userc']=userc::where('date_out','like','%'.$request->date_outd.'%')->paginate(20);
        }elseif($request->stated){
            $data['userd']=userd::where('state','like','%'.$request->stated.'%')->paginate(20);
        }else{
            $data['userd']=userd::where('image/users','<>','')->paginate(20);
        }
        $data['contact']=contact::all();
        return view('vietninh.user.user_d', $data);
    }
}