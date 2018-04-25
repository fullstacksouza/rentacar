<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;
use App\User;
class AnswerOption extends Model
{
    //
    protected $fillable = ['question_id','option'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class,'user_answers','answer_id');
    }
}
