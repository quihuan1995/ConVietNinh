<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'images_product', 'name_product', 'price_product', 'is_sale', 'price_product_sale', 'quantity', 'start_discount', 'stop_discount', 'type_product', 'categories_id', 'sku', 'content', 'active'
    ];
     public function categories()
    {
        return $this->belongstoMany('App\categories', 'categories_id', 'id');
    }
    public function Image(){
        return $this->hasMany('App\Image','product_id','id');
    }
}