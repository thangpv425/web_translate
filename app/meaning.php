<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class meaning extends Model
{
    protected $table= 'wt_meaning';
    public function keyword(){
    	return $this.belongsTo('App\keyword','keyword_id','meaning_id');
    }
}
