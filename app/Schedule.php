<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    protected $fillable = [
    	'eventName',
        'eventDate',
        'start_time',
        'end_time'
    ];
}
