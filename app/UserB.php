<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserB extends Model
{
    protected $table = 'users_b';
    public $timestamps=false;
    protected $fillable = [
        'id', 'user_id_a', 'user_id_b','name','phone','password','adress','avatar','state','date_in','date_out'
    ];
    public function User(){
        return $this->belongsToMany('App\User','user_id','id');
    }
    public function UserB(){
        return $this->hasMany('App\UserC','user_id_b','id');
    }
    public function Order(){
        return $this->hasMany('App\Order','user_id_b','id');
    }
}