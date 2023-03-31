<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model 
{

    protected $table = 'offers';
    public $timestamps = true;
    protected $fillable = array('name', 'description', 'image', 'restaurant_id', 'start_date', 'end_date');

    public function restaurant()
    {
        return $this->belongsTo('App\Models\Restaurant');
    }

}