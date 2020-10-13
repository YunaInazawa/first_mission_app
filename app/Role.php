<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    public function projects(){
        return $this->belongsToMany('App\Project', 'members')
            ->withTimestamps();
    }
    public function users(){
        return $this->belongsToMany('App\User', 'members')
            ->withTimestamps();
    }
}
