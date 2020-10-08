<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Decoration extends Model
{
    public function tasks(){
        return $this->belongsToMany('App\Task', 'decorations_tasks')
            ->withTimestamps();
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
