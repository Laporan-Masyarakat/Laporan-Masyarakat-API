<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $fillable = ['username', 'email', 'password', 'token', 'role'];

    protected $hidden = ['password', 'token'];

    public function role()
    {
        return $this->hasMany('App\Role', 'id', 'role');
    }
}
