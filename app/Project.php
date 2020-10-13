<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function scenes()
    {
        return $this->hasMany('App\Scene');
    }

    public function users(){
        return $this->belongsToMany('App\User', 'members')
            ->as('members')
            ->withTimestamps();
    }
    public function roles(){
        return $this->belongsToMany('App\Role', 'members')
            ->as('members')
            ->withTimestamps();
    }
}
