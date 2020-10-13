<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // 子テーブル
    public function tasks()
    {
        return $this->hasMany('App\Task');
    }

    public function projects(){
        return $this->belongsToMany('App\Project', 'members')
            ->withPivot('is_join')
            ->withTimestamps();
    }
    public function roles(){
        return $this->belongsToMany('App\Role', 'members')
            ->withPivot('is_join')
            ->withTimestamps();
    }
}
