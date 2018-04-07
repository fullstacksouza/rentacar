<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['search_id','question','type'];

    public function search()
    {
        return $this->belongsTo(Search::class);
    }
    public function answerOptions()
    {
        return $this->hasMany(AnswerOption::class);
    }
}
