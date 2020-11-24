<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Decoration extends Model
{
    use SoftDeletes;

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
    public function move_scene()
    {
        return $this->belongsTo('App\Scene', 'move_scene_id');
    }
}
