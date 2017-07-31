<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'wt_keyword';
    public $primaryKey = 'id';
    
    public function meaning(){
    	return $this->hasMany('App\Meaning','id','keyword_id');
    }
}
