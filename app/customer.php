<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
      protected $table = 'customer';
        public $timestamps=false;
    protected $fillable = [
        'id', 'name', 'address', 'email','phone','img_customer','total','state'
    ];
     public function Order()
    {
        return $this->hasMany('App\Order', 'customer_id', 'id');
    }
}