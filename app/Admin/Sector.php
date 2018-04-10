<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Admin\Search;
class Sector extends Model
{
    //
    protected $fillable = ['name','responsible_email'];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function searches()
    {
            return $this->belongsToMany(Search::class);
    }
}
