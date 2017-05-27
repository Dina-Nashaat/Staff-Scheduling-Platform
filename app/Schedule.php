<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $fillable = [
    	'event_name',
        'event_date',
        'start_time',
        'end_time', 
        'event_color'
    ];
}
