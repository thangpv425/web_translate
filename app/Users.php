<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table = 'users';

    public function keywordTemp()
    {
    	return $this->hasMany('App\KeywordTemp');
    }

    public function meaningTemp()
    {
    	return $this->hasMany('App\MeaningTemp');
    }
}
