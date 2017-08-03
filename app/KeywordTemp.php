<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KeywordTemp extends Model {

    use SoftDeletes;

    protected $table = 'wt_keyword_temp';
    public $primaryKey = 'id';
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function keyword() {
        return $this->belongsTo('App\Keyword', 'old_keyword_id', 'id');
    }

}
