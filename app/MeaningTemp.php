<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeaningTemp extends Model
{
    protected $table = 'wt_meaning_temp';
    public $primaryKey = 'meaning_temp_id';

    public function user()
    {
    	return $this->belongsTo('App\Users');
    }

    public function keyword()
    {
        return $this->belongsTo('App\keyword', 'keyword_id', 'keyword_id');
    }

    public function oldMeaning()
    {
        return $this->hasOne('App\meaning', 'meaning_id', 'old_meaning_id');
    }
}
