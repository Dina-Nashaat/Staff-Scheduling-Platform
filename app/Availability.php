<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    
     protected $table = 'availability';
     protected $fillable = [
        'user_id',
        'date',
        'start_time',
        'end_time'
    ];
}
