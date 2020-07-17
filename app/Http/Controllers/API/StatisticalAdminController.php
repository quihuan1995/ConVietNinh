<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Controller;
use App\StatisticalAdmin;
class StatisticalAdminController extends Controller
{
    public $successStatus = 200;

    public $errorStatus = 401;

    public function getStatistical(){
        $userAdmin = StatisticalAdmin::find(1);

        return response()->json(['success' => $userAdmin], $this->successStatus);
    }

    public function getStatisticalById($id){
        $item = User::find($id);
        $data = [];
        if (!empty($item)){
            $data["id"] = $item->id;
            $data["points_vattu"] = $item->points_vattu;
            $data["points_thicong"] = $item->points_thicong;
            $data["total_points"] = $item->total_points;
            $data["total_order"] = $item->total_order;

            return response()->json(['success' => $data], $this->successStatus);
        }

        return response()->json(['error' => "tai khoan khong ton tai"], $this->errorStatus);
    }
}
