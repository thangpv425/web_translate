<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
    protected $table = 'wt_keyword';
    public $primaryKey = 'keyword_id';
    
    public function meaning(){
    	return $this->hasMany('App\Meaning','keyword_id','keyword_id');
    }
}
