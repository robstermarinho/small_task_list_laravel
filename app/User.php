<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Contracts\Auth\Authenticatable as at;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name','last_name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function tasks(){
        return $this->hasMany('App\Task');
    }
}
