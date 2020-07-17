<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $fillable = [
        'categories_id','name'
    ];
        public function categories()
    {
        return $this->belongsToMany('App\categories', 'categories_id', 'id');
    }
}