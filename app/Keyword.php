<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Keyword extends Model
{
    use SoftDeletes;
    
    protected $table = 'wt_keyword';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    
    public function meaning(){
    	return $this->hasMany('App\Meaning','id','keyword_id');
    }
}
