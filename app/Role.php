<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function projects(){
        return $this->belongsToMany('App\Project', 'members')
            ->withTimestamps();
    }
    public function users(){
        return $this->belongsToMany('App\User', 'members')
            ->withTimestamps();
    }
}
