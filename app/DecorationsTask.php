<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DecorationsTask extends Model
{
    // 親テーブル
    public function decoration()
    {
        return $this->belongsTo('App\Decoration');
    }
    public function task()
    {
        return $this->belongsTo('App\Task');
    }
}
