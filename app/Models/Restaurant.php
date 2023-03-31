<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model 
{

    protected $table = 'restaurants';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'password', 'region_id', 'phone', 'minimum_order', 'delivery_cost', 'contact_phone', 'whatsapp', 'image', 'status', 'device_name');

    public function offers()
    {
        return $this->hasMany('App\Models\Offer');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function meals()
    {
        return $this->hasMany('App\Models\Meal');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

}