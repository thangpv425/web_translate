<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meaning extends Model
{
    protected $table= 'wt_meaning';
    public $primaryKey = 'id';

    public function keyword(){
    	return $this->belongsTo('App\Keyword','keyword_id','id');
    }
}
