<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class keyword extends Model
{
    protected $table = 'wt_keyword';
    
    public function meaning(){
    	return $this->hasMany('App\meaning','keyword_id','keyword_id');
    }
}
