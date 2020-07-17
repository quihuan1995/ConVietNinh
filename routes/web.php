<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Events\WebSocketEvent;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Broadcast;

Route::get('/', function () {

    return view('welcome');
});



Route::get('login', 'VietNinh\LoginVNController@GetLogin')->middleware('CheckLogout');
Route::post('checklogin', 'VietNinh\LoginVNController@CheckLogin');
Route::get('logout', 'VietNinh\LoginVNController@Logout');

Route::group(['prefix' => 'home','middleware'=>'CheckLogin'], function () {
    Route::get('', 'VietNinh\HomeController@GetHome');
    Route::post('contact', 'VietNinh\HomeController@Contact');
    Route::get('dashboard', 'VietNinh\DashBoardController@GetDashboard');

    //Category
    Route::group(['prefix' => 'category'], function () {
        Route::get('', 'VietNinh\CategoryVNController@GetCategory');
        Route::get('add', 'VietNinh\CategoryVNController@GetAddCate');
        Route::post('add', 'VietNinh\CategoryVNController@PostAddCate');
        Route::get('edit/{id}', 'VietNinh\CategoryVNController@GetEditCate');
        Route::post('edit/{id}', 'VietNinh\CategoryVNController@PostEditCate');
        Route::get('delete/{id}', 'VietNinh\CategoryVNController@DeleteCate');

        //Menu
        Route::get('addmenu', 'VietNinh\CategoryVNController@Menu');
        Route::post('addmenu', 'VietNinh\CategoryVNController@AddMenu');
        Route::get('editmenu/{id}', 'VietNinh\CategoryVNController@GetEditMenu');
        Route::post('editmenu/{id}', 'VietNinh\CategoryVNController@EditMenu');
        Route::get('del/{id}', 'VietNinh\CategoryVNController@DeleteMenu');

    });

    //Product
    Route::group(['prefix' => 'product'], function () {
        Route::get('', 'VietNinh\ProductVNController@GetProduct');
        Route::get('add', 'VietNinh\ProductVNController@GetAddPrd');
        Route::post('add', 'VietNinh\ProductVNController@PostAddPrd');
        Route::get('edit/{id}', 'VietNinh\ProductVNController@GetEditPrd');
        Route::post('edit/{id}', 'VietNinh\ProductVNController@PostEditPrd');
        Route::get('delete/{id}', 'VietNinh\ProductVNController@DeletePrd');
        Route::get('history', 'VietNinh\ProductVNController@History');
        Route::post('history', 'VietNinh\ProductVNController@AddHistory');
        Route::get('search', 'VietNinh\ProductVNController@SearchPrd');
    });
    //Order
    Route::group(['prefix' => 'order'], function () {
        Route::get('', 'VietNinh\OrderVNController@GetOrder');
        Route::group(['prefix' => 'add'], function () {
            Route::get('', 'VietNinh\OrderVNController@GetAddOrder');
            Route::post('','VietNinh\OrderVNController@PostAddOrder');
            Route::get('add-cart/{id}','VietNinh\OrderVNController@AddCart');
            Route::get('update/{rowId}/{qty}','VietNinh\OrderVNController@UpdateCart') ;
            Route::get('DelCart/{rowId}','VietNinh\OrderVNController@DelCart') ;
        });
        Route::get('detail/{id}', 'VietNinh\OrderVNController@DetailOrder');
        Route::get('deliver/{id}', 'VietNinh\OrderVNController@DeliverOrder');
        Route::get('work/{id}', 'VietNinh\OrderVNController@WorkOrder');
        Route::get('success/{id}', 'VietNinh\OrderVNController@SuccessOrder');
        Route::get('active/{id}', 'VietNinh\OrderVNController@ActiveOrder');
        Route::get('search', 'VietNinh\OrderVNController@SearchOrder');
    });

    //User
    Route::group(['prefix' => 'user'], function () {
        Route::get('user-c', 'VietNinh\UserVNController@GetUserC');
        Route::get('user-d', 'VietNinh\UserVNController@GetUserD');
        Route::get('add-c', 'VietNinh\UserVNController@GetaddUser_C');
        Route::post('add-c', 'VietNinh\UserVNController@PostaddUser_C');
        Route::get('edit-c/{id}', 'VietNinh\UserVNController@GetEditUser_C');
        Route::post('edit-c/{id}', 'VietNinh\UserVNController@PostEditUser_C');
        Route::get('delete-c/{id}', 'VietNinh\UserVNController@DeleteUser_C');
        Route::get('add-d', 'VietNinh\UserVNController@GetaddUser_D');
        Route::post('add-d', 'VietNinh\UserVNController@PostaddUser_D');
        Route::get('edit-d/{id}', 'VietNinh\UserVNController@GetEditUser_D');
        Route::post('edit-d/{id}', 'VietNinh\UserVNController@PostEditUser_D');
        Route::get('delete-d/{id}', 'VietNinh\UserVNController@DeleteUser_D');
        Route::get('search_c', 'VietNinh\UserVNController@SearchUserC');
        Route::get('search_d', 'VietNinh\UserVNController@SearchUserD');
    });

    //Customer
    Route::group(['prefix' => 'customer'], function () {
        Route::get('', 'VietNinh\CustomerVNController@GetCustomer');
        Route::get('detail/{id}', 'VietNinh\CustomerVNController@DetailCustomer');
        Route::get('search', 'VietNinh\CustomerVNController@SearchCustomer');
    });
});