<?php

namespace App\Mariadb\Backend;

use App\Mariadb\Model;

class User extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function posts() {
        return $this->hasMany('App\Mariadb\Backend\BackendPost', 'user_id', 'id');
    }

}
