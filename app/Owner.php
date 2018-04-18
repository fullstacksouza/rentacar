<?php

namespace App;
use Car;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    //
    protected $fillable = ['name'];
    public function car()
    {
        return $this->hasOne(Car::class);
    }
}
