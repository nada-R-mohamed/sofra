<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model 
{

    protected $table = 'regions';
    public $timestamps = true;
    protected $fillable = array('name', 'city_id');

    public function governorate()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function restaurants()
    {
        return $this->hasMany('App\Models\Restaurant');
    }

    public function clients()
    {
        return $this->hasMany('App\Models\Client');
    }

}