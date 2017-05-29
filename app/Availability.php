<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    
     protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
