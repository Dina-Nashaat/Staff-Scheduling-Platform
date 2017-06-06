<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;

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

    public function hasRole($roles)
    {
        foreach($roles as $role)
        {
            if($this->role()->where('role_name',$role)->first())
                return true;
        }
        return false;
    }

    public function hasPermissions($permissions)
    {
        foreach($permissions as $permission)
        {
            $sth  = DB::table('permission_role')
                ->join('roles','roles.id','permission_role.role_id')
                ->join('permissions','permissions.id','permission_role.permission_id')
                ->join('users','users.role_id','roles.id');
            
            $exists = $sth->where([['users.id','=',$this->id],['permission_name','=',$permission]])
                                            ->select('permissions.id')->get()->toArray();
            if(empty($exists))
                return false;
        }
        return true;
    }
}