<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class history extends Model
{
       protected $table = 'history';
    protected $fillable = [
        'id','histories','quantity','ImExPort','price','total_price'
    ];

}