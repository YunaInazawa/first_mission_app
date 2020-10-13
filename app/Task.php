<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

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
