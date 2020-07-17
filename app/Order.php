<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $fillable = [
        'user_id', 'user_id_b', 'user_id_c', 'order_status', 'total', 'addrees',
        'total_price_construction', 'total_price', 'order_date', 'order_start_date', 'order_start_date','customer_id'
    ];
    public function Customer(){
        return $this->belongsTo('App\customer','customer_id','id');
    }
    public function User(){
        return $this->belongsToMany('App\User','user_id','id');
    }
    public function UserB(){
        return $this->belongsToMany('App\UserB','user_id_b','id');
    }
    public function UserC(){
        return $this->belongsToMany('App\UserC','user_id_c','id');
    }
    public function Order_item(){
        return $this->hasMany('App\Order_item','order_id','id');
    }
    public function OrderForD(){
        return $this->hasMany('App\OrderForD','order_id','id');
    }
    public function OrderItemThicong(){
        return $this->hasMany('App\OrderItemThicong','order_id','id');
    }
}