<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decoration extends Model
{
    // 子テーブル
    public function decorations_tasks()
    {
        return $this->hasMany('App\DecorationsTask');
    }

    // 親テーブル
    public function element()
    {
        return $this->belongsTo('App\Element');
    }
    public function scene()
    {
        return $this->belongsTo('App\Scene');
    }
}
