<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoryRestaurant extends Model 
{

    protected $table = 'category_restaurant';
    public $timestamps = true;
    protected $fillable = array('restaurant_id', 'category_id');

}