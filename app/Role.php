<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // 子テーブル
    public function members()
    {
        return $this->hasMany('App\Member');
    }
}
