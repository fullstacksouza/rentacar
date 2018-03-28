<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    //
    protected $fillable = ['title','date_start','date_end'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function sectors()
    {
        return $this->belongsToMany(Sector::class,'search_sectors','search_id','sector_id');
    }
}
