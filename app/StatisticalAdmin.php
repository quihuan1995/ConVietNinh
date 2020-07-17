<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatisticalAdmin extends Model
{
    protected $table = 'total_for__admin';
    protected $fillable = [
        'points_vattu', 'points_thicong', 'total_points', 'total_order'
    ];
}
