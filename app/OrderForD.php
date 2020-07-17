<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderForD extends Model
{
    protected $table = 'order_for__d';
    protected $fillable = [
        'id', 'user_id_d', 'order_id', 'collect_money', 'order_date'
    ];
     public function Order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
    public function UserD(){
        return $this->belongsTo('App\UserD','user_id_d','id');
    }
}
