<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categories extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'id', 'categories', 'images_category', 'name'
    ];
     public function product()
    {
        return $this->hasMany('App\Product', 'categories_id', 'id');
    }
      public function child()
    {
        return $this->hasMany('App\categories', 'name', 'id');
    }
    public function Menu(){
        return $this->hasMany('App\Menu','categories_id','id');
    }
}