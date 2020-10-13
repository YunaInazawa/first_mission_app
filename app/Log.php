<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Log extends Model
{
    use SoftDeletes;

    // 親テーブル
    public function log_category()
    {
        return $this->belongsTo('App\LogCategory');
    }
}
