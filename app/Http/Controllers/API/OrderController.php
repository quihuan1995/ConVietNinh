<?php

namespace App\Http\Controllers\API;

use App\Order_item;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Http\Controllers\Controller;
use App\Order;
use App\User;
use App\OrderForD;
use App\OrderItemThicong;
class OrderController extends Controller
{
    public $successStatus = 200;

    public $errorStatus = 401;

    public function getOrderForB($id, $limit){
        $user = User::find($id);
        if (!empty($user) && $user->admin == 2){
            $order = Order::where('addrees', '=', $user->address)->orderBy('updated_at', 'desc')->paginate($limit);
            $dataAllOrder = $dataAllOrder = $this->getAllOrderForDByDate($order, 'C');
            return response()->json(['success' => $dataAllOrder], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan B"], $this->errorStatus);
    }

    public function addThicongForOrder(Request $request){
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'order_id' => 'required',
            'item_thicong' => 'required',
            'total_price_construction' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->erro);
        }
        $item = Order::find($request["order_id"]);
        if (!empty($item)){
            if (!empty($request["item_thicong"])){
                $item->total_price_construction = $request["total_price_construction"];
                $item->total_price = (int)$item->total + (int)$request["total_price_construction"];
                $item->save();

                foreach ($request['item_thicong'] as $_item){
                    $order_item = new OrderItemThicong();
                    $order_item->order_id = $item->id;
                    $order_item->product_id = $_item['product_id'];
                    $order_item->quantity = $_item['quantity'];
                    $order_item->default_price = $_item['default_price'];
                    $order_item->total_price = $_item['total_price'];
                    $order_item->save();
                }
                $item["item"] = $this->getDataItemOrder($request["order_id"]);
                $item["item_thicong"] = $this->getDataItemThicongOrder($request["order_id"]);
                $item["data_all_users_d"] = $this->getDataUserDForOrder($request["order_id"]);
                return response()->json(['success' => $item], $this-> successStatus);
            }
            return response()->json(['error' => "them thi cong loi"], $this->errorStatus);
        }

        return response()->json(['error' => "order khong toi tai"], $this->errorStatus);
    }

    private function getDataItemOrder($id){
        $order_item = Order_item::where('order_id', '=', $id)->get();
        $__itemOrder = [];
        foreach ($order_item as $_item) {
            $__itemProduct = DB::table('products')->find($_item->product_id);
            if (!empty($__itemProduct)){
                $array = [
                    "image_product" => $__itemProduct->images_product,
                    "name_product" => $__itemProduct->name_product,
                    "sku" => $__itemProduct->sku,
                    "quatity" => $_item->quantity,
                    "total_price" => $_item->total_price
                ];
                array_push($__itemOrder, $array);
            }
        }

        return $__itemOrder;
    }

    private function getDataUserDForOrder($id){
        $dataOdrerD = OrderForD::where('order_id', '=', $id)->orderBy('updated_at', 'desc')->get();
        $dataAllUserD = [];
        foreach ($dataOdrerD as $__item){
            $user = User::find($__item->user_id_d);
            if (!empty($user)){
                $user["collect_money"] = $__item->collect_money;
                $user["id_d_order"] = $__item->id;
                array_push($dataAllUserD, $user);
            }
        }

        return $dataAllUserD;
    }

    private function getDataItemThicongOrder($id){
        $order_item_thicong = OrderItemThicong::where('order_id', '=', $id)->get();
        $__itemOrderThicong = [];
        foreach ($order_item_thicong as $_item_thicong) {
            $__itemProductThicong = DB::table('products')->find($_item_thicong->product_id);
            if (!empty($__itemProductThicong)){
                $arrayThicong = [
                    "image_product" => $__itemProductThicong->images_product,
                    "name_product" => $__itemProductThicong->name_product,
                    "sku" => $__itemProductThicong->sku,
                    "quatity" => $_item_thicong->quantity,
                    "total_price" => $_item_thicong->total_price
                ];
                array_push($__itemOrderThicong, $arrayThicong);
            }
        }

        return $__itemOrderThicong;
    }

    public function getOrderByStattus($id, $limit, $stattus){
        $user = User::find($id);
        if (!empty($user) && $user->admin == 2){
            $order = Order::where('addrees', '=', $user->address)->where('order_status', '=', (string)$stattus)->orderBy('updated_at', 'desc')->paginate($limit);
            $dataAllOrder = [];
            foreach ($order as $value){
                $__item = Order::find($value["id"]);
                $__item["item"] = $this->getDataItemOrder($value["id"]);
                $__item["item_thicong"] = $this->getDataItemThicongOrder($value["id"]);
                $__item["data_all_users_d"] = $this->getDataUserDForOrder($value["id"]);
                array_push($dataAllOrder, $__item);
            }
            return response()->json(['success' => $dataAllOrder], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan B"], $this->errorStatus);
    }

    public function setOrderBToC(Request $request){
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'order_id' => 'required',
            'user_id_b' => 'required',
            'user_id_c' => 'required',
            'order_start_date' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->erro);
        }

        $item = Order::find($request["order_id"]);
        if (!empty($item)){
            $item->order_start_date = $request["order_start_date"];
            $item->user_id_b = $request["user_id_b"];
            $item->user_id_c = $request["user_id_c"];
            $item->save();

            return response()->json(['success' => $item], $this->successStatus);
        }

        return response()->json(['error' => "order khong toi tai"], $this->errorStatus);
    }

    public function getOrderForC($id, $limit){
        $user = User::find($id);
        if (!empty($user) && $user->admin == 3){
            $order = Order::where('user_id_c', '=', $id)->orderBy('updated_at', 'desc')->paginate($limit);
            $dataAllOrder = $this->getAllOrderForDByDate($order, 'C');
            return response()->json(['success' => $dataAllOrder], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan C"], $this->errorStatus);
    }

    public function getOrderCByStatus($id, $limit, $stattus){
        $user = User::find($id);
        if (!empty($user) && $user->admin == 3){
            $order = Order::where('user_id_c', '=', $id)->where('order_status', '=', (string)$stattus)->orderBy('updated_at', 'desc')->paginate($limit);
            $dataAllOrder = [];
            foreach ($order as $value){
                $__item = Order::find($value["id"]);
                $__item["item"] = $this->getDataItemOrder($value["id"]);
                $__item["item_thicong"] = $this->getDataItemThicongOrder($value["id"]);
                $__item["data_all_users_d"] = $this->getDataUserDForOrder($value["id"]);
                array_push($dataAllOrder, $__item);
            }
            return response()->json(['success' => $dataAllOrder], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan C"], $this->errorStatus);
    }

    public function setOrderCforD(Request $request){
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'order_id' => 'required',
            'users_id_d' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->erro);
        }

        $item = Order::find($request["order_id"]);
        if (!empty($item)){
            foreach ($request["users_id_d"] as $key => $value){
                $checkUserD = $this->checkUserDForOrder($request["order_id"], $value["user_id_d"]);
                if(!$checkUserD){
                    return response()->json(['error' => "tai khoan da ton tai trong order"], $this->errorStatus);
                }
                $date = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
                $itemOrder = new OrderForD();
                $itemOrder->order_id = $request["order_id"];
                $itemOrder->user_id_d = $value["user_id_d"];
                $itemOrder->collect_money = $value["collect_money"];
                $itemOrder->order_date = $date;
                $itemOrder->save();
            }
            $item["item"] = $this->getDataItemOrder($request["order_id"]);
            $item["item_thicong"] = $this->getDataItemThicongOrder($request["order_id"]);
            $item["data_all_users_d"] = $this->getDataUserDForOrder($request["order_id"]);

            return response()->json(['success' => $item], $this->successStatus);
        }

        return response()->json(['error' => "order khong toi tai"], $this->errorStatus);
    }

    public function checkUserDForOrder($orderId, $userDId){
        $item = OrderForD::where('user_id_d', '=', $userDId)->where('order_id', '=', $orderId)->orderBy('updated_at', 'desc')->paginate(5);
        if ((int)$item->count() > 0){
            return false;
        }
        return true;
    }

    public function getOrderDbyId($id, $limit){
        $user = User::find($id);
        if (!empty($user) && $user->admin == 4){
            $item = OrderForD::where('user_id_d', '=', $id)->orderBy('updated_at', 'desc')->paginate($limit);
            $dataAllOrder = $this->getAllOrderForDByDate($item, 'D');
            return response()->json(['success' => $dataAllOrder], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan D"], $this->errorStatus);
    }

    public function getOrderIdByUserId($orderId, $userId)
    {
        $user = User::find($userId);
        if (!empty($user) && ($user->admin == 2 || $user->admin == 3 || $user->admin == 4)){
            if ($user->admin == 2 || $user->admin == 3){
                if ($user->admin == 2){
                    $__value = 'user_id_b';
                }else{
                    $__value = 'user_id_c';
                }
                $order = Order::where($__value , '=', $userId)->where('id', '=', $orderId)->orderBy('updated_at', 'desc')->get();
                $dataAllOrder = [];
                foreach ($order as $value){
                    $__item = Order::find($value["id"]);
                    $__userClient = User::find($__item->user_id);
                    $__item["phone_client"] = $__userClient->phone;
                    $__item["name_client"] = $__userClient->name;
                    $__item["item"] = $this->getDataItemOrder($value["id"]);
                    $__item["item_thicong"] = $this->getDataItemThicongOrder($value["id"]);
                    $__item["data_all_users_d"] = $this->getDataUserDForOrder($value["id"]);
                    array_push($dataAllOrder, $__item);
                }
                return response()->json(['success' => $dataAllOrder], $this->successStatus);
            }else{
                $item = OrderForD::where('user_id_d', '=', $userId)->where('order_id', '=', $orderId)->orderBy('updated_at', 'desc')->get();
                $dataAllOrder = [];
                foreach ($item as $value){
                    $__item = Order::find($value["order_id"]);
                    $__userClient = User::find($__item->user_id);
                    $__item["phone_client"] = $__userClient->phone;
                    $__item["name_client"] = $__userClient->name;
                    $__item["item"] = $this->getDataItemOrder($__item["id"]);
                    $__item["item_thicong"] = $this->getDataItemThicongOrder($__item["id"]);
                    $__item["data_all_users_d"] = $this->getDataUserDForOrder($__item["id"]);
                    array_push($dataAllOrder, $__item);
                }
                return response()->json(['success' => $dataAllOrder], $this->successStatus);
            }
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan admin"], $this->errorStatus);
    }

    public function fillterOrderByOrderDate($startdate, $stopdate, $userid){
        $user = User::find($userid);
        $startdate = date("Y-m-d H:i", strtotime($startdate));
        $stopdate = date("Y-m-d H:i", strtotime($stopdate));
        if (!empty($user) && ($user->admin == 2 || $user->admin == 3 || $user->admin == 4)){
            if ($user->admin == 2 || $user->admin == 3){
                if ($user->admin == 2){
                    $__value = 'user_id_b';
                }else{
                    $__value = 'user_id_c';
                }
                $order = Order::where($__value , '=', $userid)->where('order_date', '>', $startdate)->where('order_date', '<', $stopdate)->orderBy('updated_at', 'desc')->get();
                $dataAllOrder = $this->getAllOrderForDByDate($order, 'C');
            } else {
                $item = OrderForD::where('user_id_d', '=', $userid)->where('order_date', '>', $startdate)->where('order_date', '<', $stopdate)->orderBy('updated_at', 'desc')->get();
                $dataAllOrder = $this->getAllOrderForDByDate($item, '');
            }
            return response()->json(['success' => $dataAllOrder], $this->successStatus);
        }
        return response()->json(['error' => "Tai khoan cua ban khong phai la tai khoan admin"], $this->errorStatus);
    }

    public function getOrderByOrderId($id){
        $__item = Order::find($id);
        if (!empty($__item)){
            $__userClient = User::find($__item->user_id);
            $__item["phone_client"] = $__userClient->phone;
            $__item["name_client"] = $__userClient->name;
            $__item["item"] = $this->getDataItemOrder($id);
            $__item["item_thicong"] = $this->getDataItemThicongOrder($id);
            $__item["data_all_users_d"] = $this->getDataUserDForOrder($id);

            return response()->json(['success' => $__item], $this->successStatus);
        }
        return response()->json(['error' => "Order khong ton tai"], $this->errorStatus);
    }

    public function getAllOrderForDByDate($item, $type) {
        $dataAllOrder = [];
        $total_all_order = 0;
        $count_order = 0;
        foreach ($item as $value){
            $count_order++;
            $data = [];
            if (!empty($type) && $type == 'C'){
                $__id = $value["id"];
            }else{
                $__id = $value["order_id"];
            }
            $__item = Order::find($__id);
            $user = User::find($__item->user_id);
            $__item['name'] = $user->name;
            $__item['phone'] = $user->phone;
            $__item["item"] = $this->getDataItemOrder($__item["id"]);
            $__item["item_thicong"] = $this->getDataItemThicongOrder($__item["id"]);
            $__item["data_all_users_d"] = $this->getDataUserDForOrder($__item["id"]);
            $total_all_order += $__item->total_price;
            $order_date = $__item->order_date;
            $order_date = date("Y-m-d", strtotime($order_date));
            if (count($dataAllOrder)) {
                $dataOrderDate = $dataAllOrder['data'];
                $count = 0;
                foreach ($dataOrderDate as $key => $dataOrder) {
                    if ($dataOrder['date'] == $order_date) {
                        $dataAllOrder['data'][$key]['data_user'][] = $__item;
                        $dataAllOrder['data'][$key]['total_price_date'] += $__item->total_price;
                        $count++;
                    }
                }
                if ($count == 0) {
                    $data['date'] = $order_date;
                    $data['data_user'][] = $__item;
                    $data['total_price_date'] = $__item->total_price;
                } else {
                    continue;
                }
            } else {
                $data['date'] = $order_date;
                $data['data_user'][] = $__item;
                $data['total_price_date'] = $__item->total_price;
            }
            $dataAllOrder['data'][] = $data;
        }
        $dataAllOrder['total_all_order'] = $total_all_order;
        $dataAllOrder['count_order'] = $count_order;
        return $dataAllOrder;
    }

    public function deleteUserDForOrder($id){
        $__item = OrderForD::find($id);
        if (!empty($__item)){
            $__item->delete();
            return response()->json(['success' => "xoa thanh cong"], $this->successStatus);
        }
        return response()->json(['error' => "id khong ton tai"], $this->errorStatus);
    }
}
