<?php

namespace App\Admin;
use App\User;
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

    public function users()
    {
        return $this->belongsToMany(User::class,'user_searches');
    }

    public function getStatus($status)
    {
        if($status == 0)
        {
            return "Não publicada";
        }
        return "Publicada";
    }
}
