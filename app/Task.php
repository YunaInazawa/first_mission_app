<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    // 子テーブル
    public function decorations_tasks()
    {
        return $this->hasMany('App\DecorationsTask');
    }

    // 親テーブル
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function status()
    {
        return $this->belongsTo('App\Status');
    }
    public function scene()
    {
        return $this->belongsTo('App\Scene');
    }
}
