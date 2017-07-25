<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';
    protected $fillable = [
        'id',
        'slug',
        'name',
        'permissions',
        'deleted_by',
        'updated_by',
        'created_by',
        'created_at',
        'updated_at'
    ];
}
