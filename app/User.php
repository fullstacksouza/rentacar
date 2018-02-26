<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Admin\Sector;
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;
   

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','sector_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sectors()
    {
        return $this->belongsToMany(Sector::class)->withTimestamps();
    }

    public function roles()
    {
      return $this->belongsToMany('App\Role');
    }


}
