<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeywordTemp extends Model
{
    protected $table = 'wt_keyword_temp';
    public $primaryKey = 'keyword_temp_id';

    public function user()
    {
    	return $this->belongsTo('App\Users', 'user_id', 'id');
    }

    public function keyword()
    {
    	return $this->belongsTo('App\keyword', 'old_keyword_id', 'keyword_id');
    }
}
