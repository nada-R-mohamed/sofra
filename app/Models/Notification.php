<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model 
{

    protected $table = 'notifications';
    public $timestamps = true;
    protected $fillable = array('notifiable', 'title', 'content', 'is_read');

    public function notifiable()
    {
        return $this->morphTo();
    }

}