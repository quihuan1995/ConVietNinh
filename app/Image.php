<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images_product';
    protected $fillable = [
        'id','product_id', 'image'
    ];
    public function Product()
    {
        return $this->belongsTo('App\Product', 'product_id', 'id');
    }
}
