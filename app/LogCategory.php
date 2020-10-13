<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LogCategory extends Model
{
    use SoftDeletes;

    // 子テーブル
    public function logs()
    {
        return $this->hasMany('App\Log');
    }
}
