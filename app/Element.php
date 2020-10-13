<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Element extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function decorations()
    {
        return $this->hasMany('App\Decoration');
    }
}
