<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model 
{

    protected $table = 'orders';
    public $timestamps = true;
    protected $fillable = array('note', 'status', 'address', 'total_price', 'payment_method_id', 'delivery_cost', 'commession');

    public function payment_method()
    {
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function meals()
    {
        return $this->belongsToMany('App\Models\Meal');
    }

    public function notifications()
    {
        return $this->morphMany('App\Models\Notification');
    }

}