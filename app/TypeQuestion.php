<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TypeQuestion extends Model
{
    protected $fiillable = [
        'name'
    ];

    public function answers()
    {
        return $this->hasMany(AnswerTypeQuestion::class);
    }
}
