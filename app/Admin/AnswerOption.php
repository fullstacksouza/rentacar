<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class AnswerOption extends Model
{
    //
    protected $fillable = ['question_id','option'];
}
