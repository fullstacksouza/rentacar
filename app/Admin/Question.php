<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\Admin\UserTextAnswer;

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

    public function textAnswer()
    {
        return $this->belongsTo(UserTextAnswer::class,'questions_id');
    }
}
