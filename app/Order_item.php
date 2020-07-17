<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order_item extends Model
{
    protected $table = 'order_item';
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'default_price', 'total_price'
    ];
         public function Order()
    {
        return $this->belongsTo('App\Order', 'order_id', 'id');
    }
}