<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    public function decorations(){
        return $this->belongsToMany('App\Decoration', 'decorations_tasks')
            ->withTimestamps();
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
