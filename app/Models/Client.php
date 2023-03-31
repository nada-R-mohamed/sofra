<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model 
{

    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('region_id', 'name', 'email', 'phone', 'password', 'device_name');

    public function city()
    {
        return $this->belongsTo('App\Models\Region');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

}