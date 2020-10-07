<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // 子テーブル
    public function scenes()
    {
        return $this->hasMany('App\Scene');
    }
    public function members()
    {
        return $this->hasMany('App\Member');
    }
}
