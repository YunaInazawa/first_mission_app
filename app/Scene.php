<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scene extends Model
{
    // 子テーブル
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }
    public function decorations()
    {
        return $this->hasMany('App\Decoration');
    }
}
