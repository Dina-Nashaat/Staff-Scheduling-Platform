<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'birthdate',
        'email',
        'password',
        'center_id',
        'state',
        'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function availability()
    {
        return $this->hasMany('Availability');
    }

    public function schedules()
    {
        return $this->belongsToMany('App\Schedule')->withTimestamps();
    }

    public function role()
    {
        return $this->belongsTo('App\Role');
    }

    public function hasRole($role)
    {
        if($this->role()->where('role_name',$role)->first())
            return true;
        else
            return false;
    }

}
