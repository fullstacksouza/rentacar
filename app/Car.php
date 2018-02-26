<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    //
    protected $fillable = ['name','owner_id'];

    public function owner()
    {
        return $this->hasMany('App\Owner');
    }
}
