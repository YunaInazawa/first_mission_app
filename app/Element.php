<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Element extends Model
{
    // 子テーブル
    public function decorations()
    {
        return $this->hasMany('App\Decoration');
    }
}
