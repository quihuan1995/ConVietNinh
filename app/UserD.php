<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserD extends Model
{
    protected $table = 'users_d';
    protected $fillable = [   'id', 'user_id_a', 'user_id_b','name','phone','password','adress','avatar','state','date_in','date_out'
    ];
       public function UserC(){
        return $this->belongsToMany('App\User','user_id_c','id');
    }
    public function OrderForD(){
        return $this->hasMany('App\Order','user_id_d','id');
    }
}