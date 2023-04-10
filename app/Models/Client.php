<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Client extends Model
{

    use HasApiTokens, Notifiable;
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
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

}
