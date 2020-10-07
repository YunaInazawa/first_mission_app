<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // 子テーブル
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
}
