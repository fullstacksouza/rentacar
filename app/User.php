<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;
use App\Admin\Sector;
use App\Admin\Search;
use App\Admin\UserTextAnswer;
use App\Admin\AnswerOption;
class User extends Authenticatable
{
    use LaratrustUserTrait;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','sector_id','dob','rg','registration'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sector()
    {
        return $this->belongsTo(Sector::class);
    }


    public function searches()
    {
        return $this->belongsToManY(Search::class,'user_searches');
    }

    public function answers()
    {
        return $this->belongsToMany(AnswerOption::class,'user_answers','user_id','id');
    }

    public function textAnswers()
    {
        return $this->belongsToMany();
    }
}
