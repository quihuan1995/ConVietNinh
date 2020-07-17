<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserC extends Model
{
    protected $table = 'users_c';
    protected $fillable = [
          'id', 'user_id_a', 'user_id_b','name','phone','password','adress','avatar','state','date_in','date_out'
    ];
       public function UserB(){
        return $this->belongsToMany('App\UserB','user_id_b','id');
    }
    public function UserD(){
        return $this->hasMany('App\UserD','user_id_d','id');
    }
    public function Order(){
        return $this->hasMany('App\Order','user_id_c','id');
    }
}