<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meaning extends Model
{
    protected $table= 'wt_meaning';
    public $primaryKey = 'meaning_id';
    public function keyword(){
    	return $this->belongsTo('App\keyword','keyword_id','keyword_id');
    }
}
