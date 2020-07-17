<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Login

Route::post('login', 'API\UserController@login');                       //login
Route::post('editprofile', 'API\UserController@editProfile');           //edit file

//Register
Route::post('register', 'API\UserController@register');                 //Create new user


//Forgot password
Route::post('forgostpassword', 'API\UserController@ResetPassword');         //forgot password

//Menu
Route::post('addmenu', 'API\UserController@addMenus');                   //add menu
Route::get('getmenu', 'API\UserController@getMenus');                     //get all menu
Route::post('deletemenu/{menu_id}', 'API\UserController@deleteMenu');      //delete menu
Route::post('editmenu', 'API\UserController@editMenu');                     //edit menu by menu_id

//Product
Route::post('addproduct', 'API\UserController@addProduct');                     //add new product
Route::get('getproduct/{menu_id}', 'API\UserController@getProductByCategory');              //get product by menu_id
Route::get('getproductdetail/{product_id}', 'API\UserController@getProductDetail');         //get product detail by prd id
Route::post('deleteproduct/{product_id}', 'API\UserController@deleteProduct');       //delete product by id
Route::post('editproduct', 'API\UserController@editProduct');                         //editproduct by id

//History
Route::get('gethistorybyuserid/{user_id}/{limit}', 'API\UserController@getHistoryByUserID');     //get history by user  id

//filter
Route::post('filterproduct', 'API\UserController@filterProduct');       //filter by name product

//Get info user for admin
Route::post('userbyname','API\UserController@getUserByName');               //get user by name
Route::get('getalluser','API\UserController@getAllUser');                   //get all user

//change pass word
Route::post('changepassword','API\UserController@changePassWord');              //change password by phone
Route::get('getuserbyid/{user_id}','API\UserController@getUserById');

//Order
Route::post('addorder', 'API\UserController@addOrder');                          //add order
Route::post('setstatusorder','API\UserController@setStatusOrder');              //set status order

//Liên hệ
Route::post('createcontact','API\ContactController@createContact');             //create contact
Route::post('deletecontact/{contact_id}','API\ContactController@deleteContact');    //delete contact
Route::get('getcontact','API\ContactController@getContact');                        //get contact

//phase 2
Route::post('registeruserb', 'API\UserAdminController@register');               //Register user B
Route::get('getuserbbyadmin/{id}', 'API\UserAdminController@getUserBByAdmin');      //get all user B for admin
Route::post('registeruserc', 'API\UserAdminController@register');                       //Register user C
Route::get('getusercbyb/{id}', 'API\UserAdminController@getUserCByB');              //get user C by B
Route::post('registeruserd', 'API\UserAdminController@register');               //Register user D
Route::get('getuserdbyc/{id}', 'API\UserAdminController@getUserDByC');          //get user D by C

// get order for admin
Route::get('getorderforb/{id}/{limit}', 'API\OrderController@getOrderForB');                 //get order for B by id
Route::get('getorderbystatus/{id}/{limit}/{status}', 'API\OrderController@getOrderByStattus');      //get order by status
Route::post('bsetordertoc', 'API\OrderController@setOrderBToC');                               //B set order for C++
Route::get('getorderforc/{id}/{limit}', 'API\OrderController@getOrderForC');                 //get order for C by id
Route::get('getordercbystatus/{id}/{limit}/{status}', 'API\OrderController@getOrderCByStatus');     //get order for C by status
Route::post('setordercford', 'API\OrderController@setOrderCforD');                      //C set order for D
Route::get('getorderdbyid/{id}/{limit}', 'API\OrderController@getOrderDbyId');          //get order D by id
Route::post('baddthicongorder', 'API\OrderController@addThicongForOrder');              //B add thi cong for order
Route::get('getorderbyid/{id}', 'API\OrderController@getOrderByOrderId');
Route::post('deleteuserdfororder/{id}', 'API\OrderController@deleteUserDForOrder');

// thong ke cho admin
Route::get('getstaticticaladmin', 'API\StatisticalAdminController@getStatistical');         //get thong ke cho admin
Route::get('getstaticticalbyid/{id}', 'API\StatisticalAdminController@getStatisticalById');  //get thong ke cho admin theo id

//search && filter
Route::get('getorderidbyuserid/{orderid}/{userid}', 'API\OrderController@getOrderIdByUserId');
Route::get('fillterorderbyorderdate/{startdate}/{stopdate}/{userid}', 'API\OrderController@fillterOrderByOrderDate');
Route::post('searchuserdbyphone', 'API\UserAdminController@searchUserDByPhone');