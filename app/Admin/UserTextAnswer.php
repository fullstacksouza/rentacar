<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class UserTextAnswer extends Model
{
    //
    protected $fillable=['user_id','question_id','answer'];

    public function textAnswer()
    {
        return $this->belongsToMany(UserTextAnswer::class,'user_text_answers','user_id','id');
    }

    public function question()
    {
        return $this->hasOne(Question::class,'id','question_id');
    }
}
