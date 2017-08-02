<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeaningTemp extends Model
{
    protected $table = 'wt_meaning_temp';
    public $primaryKey = 'id';

    public function user()
    {
    	return $this->belongsTo('App\User');
    }

    public function keyword()
    {
        return $this->belongsTo('App\Keyword', 'keyword_id', 'id');
    }

    public function oldMeaning()
    {
        return $this->hasOne('App\Meaning', 'id', 'old_meaning_id');
    }
}
