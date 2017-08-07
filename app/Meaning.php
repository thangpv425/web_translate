<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meaning extends Model {

    use SoftDeletes;

    protected $table = 'wt_meaning';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    public function keyword() {
        return $this->belongsTo('App\Keyword', 'id', 'keyword_id');
    }

}
