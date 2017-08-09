<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meaning extends Model {

    use SoftDeletes;

    protected $table = 'wt_meaning';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];
    protected $fillable = ['keyword_id','meaning','index','status','language'];

    public function keyword() {
        return $this->belongsTo('App\Keyword', 'keyword_id', 'id');
    }

}
