<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\UserB;
use App\UserC;
use App\UserD;
class UserAdminController extends Controller
{
    public $successStatus = 200;

    public $errorStatus = 401;
    public function register(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'name' => 'required',
            'phone' => 'required|unique:users,phone',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request;
        $input['password'] = bcrypt($input['password']);
        $imageName = '';
        if ($input['avatar'] != "") {
            $image = $input['avatar'];  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(10) . '.png';
            Storage::disk('local')->put($imageName, base64_decode($image));
            $imageName = Storage::url($imageName);
        }
        $user = new User();
        $user->name = $input['name'];
        $user->avatar = $imageName;
        $user->password = $input['password'];
        $user->phone = $input['phone'];
        $user->address = $input['address'];
        $user->email = $input['email'];
        $user->api_token = Str::random(60);
        $user->admin = $input['admin'];
        $user->create_product = $input['create_product'];
        $user->save();
        if ($user->admin != 0) {
            $admin = 'admin';
        } else {
            $admin = 'user';
        }
        $array = [
            'api_token' => $user->api_token,
            'admin' => $admin
        ];
        if ($user->admin == 2){
            $this->createItemUserB($request["user_id_admin"], $user->id);
        }
        if ($user->admin == 3){
            $this->createItemUserC($request["id_user_b"], $user->id);
        }
        if ($user->admin == 4){
            $this->createItemUserD($request["id_user_c"], $user->id);
        }
        return response()->json(['success' => $array], $this->successStatus);
    }

    public function createItemUserB($parrentId, $childenID){
        $item = new UserB();
        $item->user_id_a = $parrentId;
        $item->user_id_b = $childenID;
        $item->save();
    }

    public function createItemUserC($parrentId, $childenID){
        $item = new UserC();
        $item->user_id_b = $parrentId;
        $item->user_id_c = $childenID;
        $item->save();
    }

    public function createItemUserD($parrentId, $childenID){
        $item = new UserD();
        $item->user_id_c = $parrentId;
        $item->user_id_d = $childenID;
        $item->save();

    }

    public function getUserBByAdmin($id)
    {
        $userAdmin = User::find($id);
        if (!empty($userAdmin) && $userAdmin->admin == 1){
            $item = UserB::orderBy('updated_at', 'asc')->get();
            $dataUserB = [];
            foreach ($item as $key => $value){
                $id = $value->user_id_b;
                $data = User::find($id);
                array_push($dataUserB, $data);
            }
            return response()->json(['success' => $dataUserB], $this->successStatus);
        }

        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan admin "], $this->errorStatus);
    }

    public function getUserCByB($id){
        $userB = User::find($id);
        if (!empty($userB) && $userB->admin == 2){
            $item = UserC::where('user_id_b', '=', $id)->orderBy('updated_at', 'desc')->get();
            $dataAllUserC = [];
            foreach ($item as $key => $value){
                $id = $value->user_id_c;
                $data = User::find($id);
                array_push($dataAllUserC, $data);
            }

            return response()->json(['success' => $dataAllUserC], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan admin "], $this->errorStatus);
    }

    public function getUserDByC($id){
        $userC = User::find($id);
        if (!empty($userC) && $userC->admin == 3){
            $item = UserD::where('user_id_c', '=', $id)->orderBy('updated_at', 'desc')->get();
            $dataAllUserD = [];
            foreach ($item as $key => $value){
                $id = $value->user_id_d;
                $data = User::find($id);
                array_push($dataAllUserD, $data);
            }

            return response()->json(['success' => $dataAllUserD], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan admin "], $this->errorStatus);
    }

    public function searchUserDByPhone(Request $request) {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'id' => 'required',
            'phone_number' => 'regex:/[0-9]/',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $id = $request['id'];
        $phone_number = $request['phone_number'];
        $userC = User::find($id);
        if (!empty($userC) && $userC->admin == 3){
            $item = UserD::where('user_id_c', '=', $id)->orderBy('updated_at', 'desc')->get();
            $dataAllUserD = [];
            foreach ($item as $key => $value){
                $id = $value->user_id_d;
                $data = User::where('phone', 'like', '%' .$phone_number. '%')
                    ->where('id', $id)
                    ->get();
                foreach ($data as $v) {
                    $dataAllUserD[] = $v;
                }
            }

            return response()->json($dataAllUserD, $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan admin "], $this->errorStatus);
    }
}