<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model 
{

    protected $table = 'contacts_us';
    public $timestamps = true;
    protected $fillable = array('name', 'email', 'phone', 'message', 'type_of_request');

}