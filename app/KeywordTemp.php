<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KeywordTemp extends Model {

    protected $table = 'wt_keyword_temp';
    public $primaryKey = 'id';
    protected $fillable = ['opCode', 'user_id', 'old_keyword_id', 'new_keyword', 'status', 'comment'];

    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function keyword() {
        return $this->belongsTo('App\Keyword', 'old_keyword_id', 'id');
    }

}
