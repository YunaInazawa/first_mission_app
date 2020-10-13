<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    // 親テーブル
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
    public function project()
    {
        return $this->belongsTo('App\Project');
    }
}
