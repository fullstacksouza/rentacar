<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    //
    protected $fillable = ['question_id','option'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
