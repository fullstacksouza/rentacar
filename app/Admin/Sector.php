<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Sector extends Model
{
    //
    protected $fillable = ['name','responsible_email'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
}
