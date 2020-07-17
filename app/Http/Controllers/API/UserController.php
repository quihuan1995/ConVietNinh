<?php

namespace App\Http\Controllers\API;

use App\Image;
use App\Order;
use App\Order_item;
use App\OrderForD;
use App\Product;
use Illuminate\Http\Request;
use Validator;
use \Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Menu;
use App\StatisticalAdmin;
class UserController extends Controller
{
    public $successStatus = 200;

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

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
        $user->admin = 0;
        $user->save();
        if ($user->admin == 1) {
            $admin = 'admin';
        } else {
            $admin = 'user';
        }
        $array = [
            'api_token' => $user->api_token,
            'admin' => $admin
        ];

        return response()->json(['success' => $array], $this->successStatus);
    }

    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */

    public function login(Request $request)
    {

        $request = json_decode($request->getContent(), true);
        if (Auth::attempt(['phone' => $request['phone'], 'password' => $request['password']])) {
            $user = Auth::user();
            return response()->json(['success' => $user], $this->successStatus);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * forgostpassword rest api
     *
     * @return string
     */
    public function ResetPassword(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $user = User::where('phone', '=', $request['phone'])->first();
        $validator = Validator::make($request, [
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if (!Hash::check($request['password'], $user->password)) {
            $user->password = bcrypt($request['password']);
            $user->save();
            return response()->json(['success' => 'Sửa thành công'], $this->successStatus);
        } else {
            return response()->json(['error' => 'Mời nhập mật khẩu mới'], 401);
        }
    }

    /**
     * edit profile
     *
     * @return success || falese
     */
    public function editProfile(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'user_id' => 'required',
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $input = $request;
        $__check = substr($input['avatar'], 1, 7);
        if ($__check == 'storage') {
            $__avatar = $input['avatar'];
        } else {
            $image = $input['avatar'];  // your base64 encoded
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = str_random(10) . '.png';
            Storage::disk('local')->put($imageName, base64_decode($image));
            $__avatar = Storage::url($imageName);
        }
        $user = User::find($input['user_id']);
        $user->name = $input['name'];
        $user->avatar = $__avatar;
        $user->address = $input['address'];
        $user->email = $input['email'];
        $user->save();

        return response()->json(['success' => 'Success edit profile'], $this->successStatus);
    }
    /**
     * set status order Received||Walking||Complete||Cancel
     *
     * @return Success || Fail
     */
    public function setStatusOrder(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'order_id' => 'required',
            'order_status' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], $this->erro);
        }

        $__stringOrderStatus = $request['order_status'];
        if ($__stringOrderStatus == "Received" || $__stringOrderStatus == "Walking" || $__stringOrderStatus == "Cancel" || $__stringOrderStatus == "Complete") {
            $item = Order::find($request["order_id"]);
            $item->order_status = $__stringOrderStatus;
            $item->save();
            if ($__stringOrderStatus == "Complete"){
                $priceVatTu = (int)$item->total;
                $priceThiCong = (int)$item->total_price_construction;
                $totalPrice = $priceVatTu + $priceThiCong;

                $userAdmin = StatisticalAdmin::find(1);
                $userAdmin->points_vattu = (int)$userAdmin->points_vattu + $priceVatTu;
                $userAdmin->points_thicong =(int)$userAdmin->points_thicong + $priceThiCong;
                $userAdmin->total_points = (int)$userAdmin->total_points + $totalPrice;
                $userAdmin->total_order = (int)$userAdmin->total_order + 1;
                $userAdmin->save();

                $userB = User::find($item->user_id_b);
                $userB->points_vattu = (int)$userB->points_vattu + $priceVatTu;
                $userB->points_thicong =(int)$userB->points_thicong + $priceThiCong;
                $userB->total_points = (int)$userB->total_points + $totalPrice;
                $userB->total_order = (int)$userB->total_order + 1;
                $userB->save();

                $userC = User::find($item->user_id_c);
                $userC->points_vattu = (int)$userC->points_vattu + $priceVatTu;
                $userC->points_thicong =(int)$userC->points_thicong + $priceThiCong;
                $userC->total_points = (int)$userC->total_points + $totalPrice;
                $userC->total_order = (int)$userC->total_order + 1;
                $userC->save();

                $dataOdrerD = OrderForD::where('order_id', '=', $request["order_id"])->orderBy('updated_at', 'desc')->get();
                foreach ($dataOdrerD as $__item){
                    $userD = User::find($__item->user_id_d);
                    $userD->points_vattu = (int)$userD->points_vattu + $priceVatTu;
                    $userD->points_thicong =(int)$userD->points_thicong + $priceThiCong;
                    $userD->total_points = (int)$userD->total_points + $totalPrice;
                    $userD->total_order = (int)$userD->total_order + 1;
                    $userD->save();

                }


            }

            return response()->json(['success' => $item], $this->successStatus);
        }
    }

    /**
     * add menus rest api
     *
     * @return true || falese
     */
    public function addMenus(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'categories_id' => 'required',
            'name' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        DB::table('menus')->insert([
            'categories_id' => $request['categories_id'],
            'name' => $request['name']
        ]);
        return response()->json(['success' => 'Success create new menu'], $this->successStatus);

    }

    /**
     * get menu rest api
     *
     * @return data item
     */
    public function getMenus()
    {
        $item = DB::table('menus')->get();
        return response()->json(['success' => $item], $this->successStatus);
    }

    /**
     * delete menu by menu_id
     */
    public function deleteMenu($menu_id)
    {
        $item = Menu::find($menu_id)->delete();
        return response()->json(['success' => 'Xóa thành công'], $this-> successStatus);
    }

    /**
     * edit menu by menu id
     */
    public function editMenu(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'menu_id' => 'required',
            'name' => 'required','categories_id' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $item = Menu::find($request["menu_id"]);
        $item->name = $request["name"]; $item->categories_id = $request['categories_id'];
        $item->save();

        return response()->json(['success' => 'Sửa thành công'], $this-> successStatus);
    }

    /**
     * add product
     *
     * @return string
     */
    public function addProduct(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'name_product' => 'required',
            'price_product' => 'required',
            'is_sale' => 'required',
            'price_product_sale' => 'required',
            'quantity' => 'required',
            'type_product' => 'required',
            'menu_id' => 'required',
            'sku' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if ($request['type_product'] == "Nhan cong" || $request['type_product'] == "Vat tu"){
            $item = new Product();
            $item->images_product = '';
            $item->name_product = $request['name_product'];
            $item->price_product = $request['price_product'];
            $item->is_sale = $request['is_sale'];
            $item->price_product_sale = $request['price_product_sale'];
            if ($request['start_discount'] != null || $request['stop_discount'] != null){
                $item->start_discount = $request['start_discount'];
                $item->stop_discount = $request['stop_discount'];
            }
            $item->quantity = $request['quantity'];
            $item->type_product = $request['type_product'];
            $item->menu_id = $request['menu_id'];
            $item->sku = $request['sku'];
            $item->content = $request['content'];
            $item->save();
            $__imagesProduct = [];
            foreach ($request['images_product'] as $index) {
                $_itemImage = new Image();
                $image = $index['image'];  // your base64 encoded
                $image = str_replace('data:image/png;base64,', '', $image);
                $image = str_replace(' ', '+', $image);
                $imageName = str_random(10) . '.png';
                Storage::disk('local')->put($imageName, base64_decode($image));
                $imageName = Storage::url($imageName);
                array_push($__imagesProduct, $imageName);
                $_itemImage->image = $imageName;
                $_itemImage->product_id = $item->id;
                $_itemImage->save();
            }
            $item->images_product = implode(" ",$__imagesProduct);
            $item->save();
            return response()->json(['success' => $item], $this-> successStatus);
        }
        return response()->json(['error' => "dinh dang san pham sai"], 401);
    }

    /**
     * getproducts by category
     *
     * @return data json
     */
    public function getProductByCategory($menu_id)
    {
        $item = DB::table('products')->where('menu_id','=',$menu_id)->where('active','=','1')->get();
        return response()->json(['success' => $item], $this-> successStatus);
    }

    /**
     * get product detail by product id
     *
     * @return data json
     */
    public function getProductDetail($product_id){
        $item = DB::table('products')->find($product_id);
        return response()->json(['success' => $item], $this-> successStatus);
    }

    /**
     * delete product by product id
     */
    public function deleteProduct($product_id)
    {
        $item = Product::find($product_id);
        $item->active = 0;
        $item->save();
        return response()->json(['success' => 'Xóa thành công'], $this-> successStatus);
    }

    /**
     * edit product by product id
     */
    public function editProduct(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'product_id' => 'required',
            'images_product' => 'required',
            'name_product' => 'required',
            'price_product' => 'required',
            'is_sale' => 'required',
            'price_product_sale' => 'required',
            'quantity' => 'required',
            'type_product' => 'required',
            'menu_id' => 'required',
            'sku' => 'required',
            'content' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        if ($request['type_product'] == "Nhan cong" || $request['type_product'] == "Vat tu"){
            $item = Product::find($request["product_id"]);
            $__imagesProduct = [];
            foreach ($request['images_product'] as $index) {
                $image = $index['image'];
                $__check = substr( $index['image'],  1, 7);
                if ($__check == 'storage'){
                    array_push($__imagesProduct, $index['image']);
                }else{
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = str_random(10) . '.png';
                    Storage::disk('local')->put($imageName, base64_decode($image));
                    $imageName = Storage::url($imageName);
                    array_push($__imagesProduct, $imageName);
                }
            }
            $item->images_product = implode(" ",$__imagesProduct);;
            $item->name_product = $request['name_product'];
            $item->price_product = $request['price_product'];
            $item->is_sale = $request['is_sale'];
            $item->price_product_sale = $request['price_product_sale'];
            if ($request['start_discount'] != null || $request['stop_discount'] != null){
                $item->start_discount = $request['start_discount'];
                $item->stop_discount = $request['stop_discount'];
            }
            $item->quantity = $request['quantity'];
            $item->type_product = $request['type_product'];
            $item->menu_id = $request['menu_id'];
            $item->sku = $request['sku'];
            $item->content = $request['content'];
            $item->save();

            return response()->json(['success' => 'Sửa thành công'], $this-> successStatus);
        }

        return response()->json(['error' => "dinh dang san pham sai"], 401);
    }

    /**
     * add order item
     *
     * @return success || falese
     */
    public function addOrder(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'user_id' => 'required',
            'total' => 'required',
            'order_status' => 'required',
            'addrees' => 'required',
            'item' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
        $order = new Order();
        $date = Carbon::now('Asia/Ho_Chi_Minh')->toDateTimeString();
        $order->user_id = $request['user_id'];
        $order->order_status = $request['order_status'];
        $order->addrees = $request['addrees'];
        $order->total_price = $request['total'];
        $order->total = $request['total'];
        $order->order_date =  $date;
        $order->save();
        foreach ($request['item'] as $_item){
            $order_item = new Order_item();
            $order_item->order_id = $order->id;
            $order_item->product_id = $_item['product_id'];
            $order_item->quantity = $_item['quantity'];
            $order_item->default_price = $_item['default_price'];
            $order_item->total_price = $_item['total_price'];
            $order_item->save();
        }

        return response()->json(['success' => $order], $this-> successStatus);
    }

    /**
     * get history by user id
     *
     * @return data json
     */
    public function getHistoryByUserID($user_id, $limit)
    {
        $user = User::find($user_id);
        if ($user->admin){
            $order = Order::orderBy('updated_at', 'desc')->paginate($limit);
        }else{
            $order = Order::where('user_id', '=', $user_id)->orderBy('updated_at', 'desc')->paginate($limit);
        }
        $data = array();
        foreach ($order as $key => $item) {
            $order_item = Order_item::where('order_id', '=', $item->id)->get();
            $__itemOrder = array();
            $__itemUser = User::find($item->user_id);
            foreach ($order_item as $_item) {
                $__itemProduct = DB::table('products')->find($_item->product_id);
                $array = [
                    "image_product" => $__itemProduct->images_product,
                    "name_product" => $__itemProduct->name_product,
                    "sku" => $__itemProduct->sku,
                    "quatity" => $_item->quantity,
                    "total_price" => $_item->total_price
                ];
                array_push($__itemOrder, $array);
            }
            $ob = [
                "order_id" => $item->id,
                "order_status" => $item->order_status,
                "date_time" => $item->order_date,
                "total_price" => $item->total,
                "payment_method" => "Tien mat",
                "item" => $__itemOrder,
                "user" => $__itemUser
            ];
            array_push($data, $ob);
        }

        return response()->json(['success' => $data], $this->successStatus);

    }

    /**
     * filter by name product
     */
    public function filterProduct(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $__products = Product::where('name_product','like','%'.$request['name_product'].'%')->where('active','=','1')->orderBy('updated_at', 'desc')->get();
        if($__products == null){
            return response()->json(['error'=>'Bạn không tìm thấy sản phẩm'], 401);
        }

        return response()->json( ['success' => $__products], $this-> successStatus);
    }

    /**
     * get user by name
     *
     * @return data
     */
    public function getUserByName(Request $request){
        $request = json_decode($request->getContent(), true);
        $user = User::where('name','like','%'.$request['name'].'%')->get();
        if($user == null){
            return response()->json(['error'=>'Bạn không tìm thấy tài khoản'], 401);
        }
        foreach ($user as $item){
            $date =date('H:i d-m-Y', strtotime($item['updated_at']));
            $item['updated_at_new']= $date;

        }
        return response()->json( ['success' => $user], $this-> successStatus);
    }

    /**
     * get all user
     *
     * @return data
     */
    public function getAllUser(){
        $user = User::orderBy('updated_at', 'desc')->get();
        foreach ($user as $item){
            $date = date('H:i d-m-Y', strtotime($item['updated_at']));
            $item['updated_at_new']= $date;
        }
        return response()->json( ['success' => $user], $this-> successStatus);
    }

    /**
     * change password for user
     *
     * @return true||false
     */
    public function changePassWord(Request $request)
    {
        $request = json_decode($request->getContent(), true);
        $validator = Validator::make($request, [
            'phone' => 'required',
            'password' => 'required',
            'newpass' => 'required',
            'c_newpass' => 'required|same:newpass',
        ]);
        if ($validator->fails()) {
            return response()->json(['error'=>$validator->errors()], 401);
        }
        if (Auth::attempt(['phone' => $request['phone'], 'password' => $request['password']])) {
            $user = User::where('phone', '=', $request['phone'])->first();
            if (!Hash::check($request['newpass'], $user->password)) {
                $user->password = bcrypt($request['newpass']);
                $user->save();
                return response()->json(['success' => 'Sửa thành công'], $this->successStatus);
            } else {
                return response()->json(['error' => 'Mời nhập mật khẩu mới'], 401);
            }
        } else {
            return response()->json(['error' => 'mật khẩu cũ không đúng'], 401);
        }
    }

    /***/
    public function getHistoryForAdmin($user_id, $limit)
    {
        $order = Order::orderBy('updated_at', 'desc')->paginate($limit);
        $data = array();
        foreach ($order as $key => $item) {
            $order_item = Order_item::where('order_id', '=', $item->id)->get();
            $__itemOrder = array();
            foreach ($order_item as $_item) {
                $__itemProduct = DB::table('products')->find($_item->product_id);
                $array = [
                    "image_product" => $__itemProduct->images_product,
                    "name_product" => $__itemProduct->name_product,
                    "quatity" => $_item->quantity,
                    "total_price" => $_item->total_price
                ];
                array_push($__itemOrder, $array);
            }
            $ob = [
                "order_id" => $item->id,
                "date_time" => $item->order_date,
                "total_price" => $item->total,
                "payment_method" => "Tien mat",
                "item" => $__itemOrder
            ];
            array_push($data, $ob);
        }

        return response()->json(['success' => $data], $this->successStatus);
    }
}