<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MeaningTemp extends Model {

    use SoftDeletes;

    protected $table = 'wt_meaning_temp';
    public $primaryKey = 'meaning_temp_id';
    protected $dates = ['deleted_at'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function keyword() {
        return $this->belongsTo('App\Keyword', 'keyword_id', 'id');
    }

    public function oldMeaning() {
        return $this->hasOne('App\Meaning', 'id', 'old_meaning_id');
    }

}
